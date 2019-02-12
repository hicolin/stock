<?php
/**
 * User: Colin
 * Time: 2019/1/21 13:59
 */

namespace mobile\controllers;

use backend\models\AdminContent;
use backend\models\AdminMember;
use backend\models\AdminOrder;
use backend\models\AdminSetting;
use backend\models\AdminSort;
use backend\models\AdminStocks;
use backend\models\AdminStocksCategory;
use backend\models\AdminTixian;
use common\models\Common;
use Yii;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        $this->getView()->title = '首页';
        $banners = AdminSetting::find()->where(['in', 'id', [30, 31, 32]])->all();
        $announces = AdminContent::find()->where(['sortid' => 11])
            ->orderBy('addtime desc')->limit(10)->all();
        $news = AdminContent::find()->where(['sortid' => 8])
            ->orderBy('addtime desc')->limit(10)->all();
        $transactions = AdminOrder::find()->joinWith('member')
            ->orderBy('admin_order.created_time desc')
            ->limit(10)->all();
        $res = $this->getGp();
        $res = json_decode($res, true);
        $info = $res['data'];
//        self::dd($info);
        return $this->render('index', compact('banners','announces', 'news','transactions', 'info'));
    }

    public function actionQuote()
    {
        $this->getView()->title = '行情中心';
        $cateId = (int)Yii::$app->request->get('cate_id');
        $pageSize = 20;
        $query = AdminStocks::find()->where(['status' => 1]);
        if ($cateId) {
            $query->andWhere(['cate_id' => $cateId]);
        }
        $stocks = $query->orderBy('recom desc')->limit($pageSize)->all();
        $marketList = self::getMarketList($stocks);
        $categories = AdminStocksCategory::find()->all();
        if (Yii::$app->request->isPost) {
            $page = Yii::$app->request->post('page');
            $cateId = Yii::$app->request->post('cateId');
            $query = AdminStocks::find()->where(['status' => 1]);
            if ($cateId) {
                $query->andWhere(['cate_id' => $cateId]);
            }
            $stocks = $query->limit($pageSize * $page)->all();
            if (empty($stocks)) {
                return $this->json(100, '没有数据了');
            }
            $marketList = self::getMarketList($stocks);
            return $this->json(200, '获取成功', $marketList);
        }
        return $this->render('quote', compact('marketList', 'categories'));
    }

    /**
     * 组装股票代码
     * @param $stocks
     * @return bool|string
     */
    public static function getMarketList($stocks)
    {
        $marketList = '';
        foreach ($stocks as $list) {
            if ($list['cid'] == 118) { // 沪股
                $marketList .= 'sh' . $list['code'] . ',';
            } else { // 深股
                $marketList .= 'sz' . $list['code'] . ',';
            }
        }
        $marketList = substr($marketList, 0, strlen($marketList) - 1);
        return $marketList;
    }

    public function actionSearchStock()
    {
        $text = Yii::$app->request->get('text');
        if (is_numeric($text)) {
            $stocks = AdminStocks::find()->where(['like', 'code' , $text])
                ->limit(5)->asArray()->all();
        } else {
            $stocks = AdminStocks::find()->where(['like', 'name' , $text])
                ->limit(5)->asArray()->all();
        }
        if (empty($stocks)) {
            return $this->json(100, '暂无数据');
        }
        foreach ($stocks as &$list) {
            if ($list['cid'] == 118) {
                $list['new_code'] = 'sh' . $list['code'];
            }else{
                $list['new_code'] = 'sz' . $list['code'];
            }
        }
        return $this->json(200, '获取成功', $stocks);
    }

    public function actionTransaction()
    {
        $this->getView()->title = '交易';
        $isLogin = Yii::$app->session['isLogin'];
        if (!$isLogin) {
            return $this->redirect(['index/login']);
        }
        $userId = Yii::$app->session['userId'];
        $onelist = AdminMember::findOne($userId);
        //冻结资金
        $dj_m = AdminTixian::find()->where(['users_id' => $userId])->andWhere(['state'=>0])
            ->select('sum(money) as money')->asArray()->one();
        //持仓盈亏
        $profit = AdminOrder::find()->where(['user_id' => $userId])
            ->andWhere(['status'=>1])->select('sum(profit) as profit')->asArray()->one();
        //保证金
        $bzj_m = AdminOrder::find()->where(['user_id' => $userId])->andWhere(['status'=>1])
            ->select('sum(total) as total')->asArray()->one();
        //动态资产
        $dt_m = floatval($onelist->money)+floatval($bzj_m['total'])*12.5/100+floatval($profit['profit'])+floatval($dj_m['money']);
        //证券市值
        $holdings = AdminOrder::find()->where(['user_id' => $userId])->andWhere(['status'=>1])->all();
        $code = '';
        foreach ($holdings as $m => $n) {
            $code .= $n['goods_code'].',';
            $arr_hander[]=$n['order_hander'];
        }
        $codes = array('list' => $code);
        $res = Common::getGp($codes);
        $resarr=$res['data'];
        foreach ($resarr as $q => $w) {
            $arr_price[] = floatval($w['new_price']);
        }
        $z = 0;
        foreach($arr_hander as $k=>$val){
            $z += $val * $arr_price[$k];
        }
        $time = mktime('0','0','0',date('m'),date('d'),date('y'));//当天凌晨
        $jS = AdminOrder::find()->andWhere(['status'=>1,'user_id'=>Yii::$app->session['user_id']])->andWhere(['<','begin_time',$time])->select('sum(day_dy) as dy, sum(day_yk) as yk')->asArray()->one();
        if($jS['yk']>0){
            $syBzj =  $onelist->money-$jS['dy'];
        }else{
            $syBzj = $onelist->money - $jS['dy'];
        }
        return $this->render('transaction',compact('syBzj', 'dt_m', 'jS', 'z', 'dj_m', 'profit', 'onelist'));
    }

    public function actionUser()
    {
        $this->getView()->title = '我的';
        $userId = Yii::$app->session['userId'];  // 未登录下，为空
        $member = AdminMember::findOne($userId);
        return $this->render('user',compact('member'));
    }

    public function actionSendSms()
    {
        $tel = Yii::$app->request->get('tel');
        $random = mt_rand(1000, 9999);
        $res = Helper::sendSms($tel, $random);
//        $res = ['status' => 200, 'msg' => '发送成功'];
        if ($res['status'] == 200) {
            Yii::$app->session['sendTel'] = $tel;
            Yii::$app->session['sendCode'] = $random;
            Yii::$app->session['expTime'] = time() + 3600 * 3;
        }
        return $this->json($res['status'], $res['msg']);
    }

    public function actionLogin()
    {
        $this->getView()->title = '账号密码登录';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $member = AdminMember::findOne(['tel' => $post['tel']]);
            if (!$member) {
                return $this->json(100, '用户不存在');
            }
            if (!Yii::$app->security->validatePassword($post['pwd'], $member->userspwd)){
                return $this->json(100, '密码不正确');
            } else {
                $this->setLogin($member->id);
                return $this->json(200, '登录成功');
            }
        }
        return $this->render('login');
    }

    public function actionPhoneLogin()
    {
        $this->getView()->title = '手机验证码登录';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $member = AdminMember::findOne(['tel' => $post['tel']]);
            if (!$member) {
                return $this->json(100, '用户不存在');
            }
            $this->checkSms($post['tel']);
            $this->setLogin($member->id);
            return $this->json(200, '登录成功');
        }
        return $this->render('phone-login');
    }

    public function actionRegister()
    {
        $this->getView()->title = '注册';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
//            $this->checkSms($post['tel']);
            $member = AdminMember::findOne(['tel' => $post['tel']]);
            if ($member) {
                return $this->json(100, '该手机号码已注册，不能重复注册');
            }
            if ($post['inviteCode']) {
                $preMember = AdminMember::findOne(['vatation_code' => $post['inviteCode']]);
                if (!$preMember) {
                    return $this->json(100, '邀请用户不存在，请确认邀请码');
                }
                $pid = $preMember->id;
            } else {
                $pid = '';
            }
            $member = new AdminMember();
            $res = $member->register($post['tel'], $post['pwd'], $post['inviteCode'], $pid);
            if ($res['status'] == 200) {
                return $this->json(200, '注册成功');
            } else {
                return $this->json(100, $res['msg']);
            }
        }
        return $this->render('register');
    }

    public function actionForgetPwd()
    {
        $this->getView()->title = '找回密码';
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $this->checkSms($post['tel']);
            if ($post['pwd'] != $post['rePwd']) {
                return $this->json(100, '两次密码输入不一致');
            }
            $member = AdminMember::findOne(['tel' => $post['tel']]);
            if (!$member) {
                return $this->json(100,'用户不存在');
            }
            $member->userspwd = Yii::$app->security->generatePasswordHash($post['pwd']);
            if (!$member->save(false)) {
                return $this->json(100, '找回失败，请稍后重新尝试');
            }
            return $this->json(200, '找回成功，请登录');
        }
        return $this->render('forget-pwd');
    }

    public function actionHelpCenter()
    {
        $this->getView()->title = '帮助中心';
        $cate = AdminSort::find()->where(['pid' => 37])->limit(20)->all();
        return $this->render('help-center', compact('cate'));
    }

    public function actionNews()
    {
        $this->getView()->title = '新闻列表';
        $news = AdminContent::find()->where(['sortid' => 8])
            ->orderBy('addtime desc')->limit(10)->all();
        return $this->render('news', compact('news'));
    }

    public function actionArticleDetail()
    {
        $id = (int)Yii::$app->request->get('id');
        $type = (int)Yii::$app->request->get('type');
        if ($type == 2) { // 按 id 查询
            $article = AdminContent::findOne(['id' => $id]);
        } else { // 按 sortid 查询
            $article = AdminContent::findOne(['sortid' => $id]);
        }
        if (!$article) {
            return $this->redirect(['index/index']);
        }
        $this->getView()->title = $article->title;
        return $this->render('article-detail', compact('article'));
    }

    public function actionAppDownload()
    {
        $this->getView()->title = 'APP下载';
        return $this->render('app-download');
    }



}