<?php

function getData($data, $type) {
	$resultData = array();
	switch ($type) {
		case "forex":
			/*
			 * "USDCNY,USDHKD,EURUSD,GBPUSD,AUDUSD,USDCHF,USDCAD,USDJPY,NZDUSD"
			  0	时间
			  1	买入价
			  2	卖出价
			  3	昨收价
			  4	振幅
			  5	开盘价
			  6	最高价
			  7	最低价
			  8	最新价
			  9	美元日元
			  10	日期
			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["time"] = $v[0]; //时间
				$value["purchase_price"] = $v[1]; //买价
				$value["selling_price"] = $v[2]; //卖价
				$value["settlement_yesterday"] = $v[3]; //昨结算
				$value["amplitude"] = $v[4]; //振幅
				$value["opening_price"] = $v[5]; //开盘价
				$value["highest_price"] = $v[6]; //最高价
				$value["minimum_price"] = $v[7]; //最低价
				$value["new_price"] = $v[8]; //最新价
				$value["name"] = $v[9]; //名称
				$value["date"] = $v[10]; //日期
				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;
		case "forex_fx":
			/*
			 * "fx_seurusd,fx_sgbpusd,fx_susdjpy,fx_saudusd,fx_susdchf,fx_susdcad,fx_snzdusd,fx_susdhkd,fx_susdrub,fx_susdkrw,fx_susdthb,fx_susdsgd"
			  0	时间
			  1	最新价
			  2
			  3	今开
			  4	波幅
			  5	昨收
			  6	最高价
			  7	最低价
			  8	最新价
			  9	欧元兑美元即期汇率
			  10	涨跌幅度
			  11	涨跌量
			  12	振幅
			  13	报价机构
			  14
			  15
			  16
			  17	日期
			 */
			foreach ($data as $k => $v) {
				$k = strtolower(substr($k, 4));
				$value = array();
				$value["time"] = $v[0]; //时间
				$value["opening_price"] = $v[3]; //开盘价
				$value["amplitude"] = $v[4]; //振幅
				$value["settlement_yesterday"] = $v[5]; //昨结算
				$value["highest_price"] = $v[6]; //最高价
				$value["minimum_price"] = $v[7]; //最低价
				$value["new_price"] = $v[8]; //最新价
				$value["name"] = $v[9]; //名称
				$value["frice_fluctuation"] = $v[10]; //涨跌幅
				$value["fluctuation"] = $v[11]; //涨跌量
				$value["quotation_institution"] = $v[13]; //报价机构
				$value["date"] = $v[17]; //日期
				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}

			break;
		case "futures":
			/*
			 * "hf_CT,hf_NID,hf_PBD,hf_SND,hf_ZSD,hf_AHD,hf_CAD,hf_S,hf_W,hf_C,hf_BO,hf_SM,hf_TRB,hf_HG,hf_NG,hf_CL,hf_SI,hf_GC,hf_LHC,hf_OIL,hf_XAU,hf_XAG,hf_XPT,hf_XPD"
			  0	最新价
			  1	涨跌幅
			  2	买价
			  3	卖价
			  4	最高价
			  5	最低价
			  6	时间
			  7	昨结算
			  8	开盘价
			  9	持仓量
			  10
			  11
			  12	日期
			  13	伦敦金
			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["new_price"] = $v[0]; //最新价
                $value["fluctuation"] = round(($v[0]-$v[7]),2); ; //涨跌量
				$value["frice_fluctuation"] = $v[1]; //涨跌幅
				$value["purchase_price"] = $v[2]; //买价
				$value["selling_price"] = $v[3]; //卖价
				$value["highest_price"] = $v[4]; //最高价
				$value["minimum_price"] = $v[5]; //最低价
				$value["time"] = $v[6]; //时间
				$value["settlement_yesterday"] = $v[7]; //昨结算
				$value["opening_price"] = $v[8]; //开盘价
				$value["open_interest"] = $v[9]; //持仓量
				$value["date"] = $v[12]; //日期
				$value["name"] = $v[13]; //名称
				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;
		case "stock":
			/*
			 * "sh000001,sz399001,sh000300,sz399415,sz399006"
			  0	指数名称
			  1	开盘价
			  2	昨收
			  3	当前指数

			  4	最高价
			  5	最低价
			  6
			  7
			  8	成交费
			  9	成交额
			  10
			  11
			  30当前日期
			  31当前时间
			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["name"] = $v[0]; //名称
				$value["opening_price"] = $v[1]; //开盘价
				$value["settlement_yesterday"] = $v[2]; //昨收
				$value["new_price"] = $v[3]; //最新价
				$value["highest_price"] = $v[4]; //最高价
				$value["minimum_price"] = $v[5]; //最低价
				$value["volume"] = $v[8]; //成交量
				$value["turnover"] = $v[9]; //交易额
				$value["date"] = $v[30]; //当前日期
				$value["time"] = $v[31]; //当前时间
				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;
		case "s_stock":
			/*
			 * 股票短查询
			 * "s_sh000001,s_sz399001,s_sz399416,s_sh000300,s_sh000011,s_sz399305"
			 * 上证指数，深证成指，I300，沪深300，基金指数，基金指数;
			  0	指数名称
			  1	最新价
			  2	涨跌量
			  3	涨跌幅
			  4	成交量
			  5	交易额
			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["name"] = $v[0]; //名称
				$value["new_price"] = $v[1]; //最新价
				$value["fluctuation"] = $v[2]; //涨跌量
				$value["frice_fluctuation"] = $v[3]; //涨跌幅
				$value["volume"] = $v[4]; //成交量
				$value["turnover"] = $v[5]; //交易额
				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;

        case "futuremarket":
            /*
             * 国内期货
             * "RB1805,HC1805,AU1712,AG1712,CU1801,AL1801,ZN1801,NI1801,RU1801,BU1712,ZC1801,MA1801,TA1801,FG1801,RM1801,OI1801,CY1801,SF1801,CF1801,SR1801,I1805,J1805,JM1805,L1805,M1801,A1801,Y1801,P1801,JD1801,C1801"
              0	名称
              1	当前时间
              2	开盘价
              3	最高价
              4	最低价
              5	最新价
              6 买价
              7 卖价
              8 买卖最高价
              9 结算价
              10 昨结算价
              11 买量
              12 卖量
              13 持仓量
              14 成交量
              15 交易所简称
              16 期货种类
              17 当前日期

             *  */
            foreach ($data as $k => $v) {
                $k = strtolower($k);
                $value = array();
                $value["name"] = $v[0]; //名称
                $value["time"] = $v[1]; //当前时间
                $value["opening_price"] = $v[2]; //开盘价
                $value["highest_price"] = $v[3]; //最高价
                $value["minimum_price"] = $v[4]; //最低价
                $value["new_price"] = $v[8]; //最新价
                $value["purchase_price"] = $v[6]; //买价
                $value["selling_price"] = $v[7]; //卖价
                $value["selling_highest_price"] = $v[5]; //买卖最高价
                $value["settlement"] = $v[9]; //结算价
                $value["settlement_yesterday"] = $v[10]; //昨结算价
                $value["purchase_num"] = $v[11]; //买量
                $value["settlement_num"] = $v[12]; //卖量
                $value["open_interest"] = $v[13]; //持仓量
                $value["volume"] = $v[14]; //成交量
                $value["exchange"] = $v[15]; //交易所简称
                $value["category"] = $v[16]; //期货种类
                $value["date"] = $v[17]; //当前日期

                if($v[10]==''){
                    $value["fluctuation"] = 0 ; //涨跌量
                    $value["frice_fluctuation"] =0; //涨跌幅
                }else {
                    $value["fluctuation"] = round(($v[8] - $v[10]), 2); //涨跌量

                    $value["frice_fluctuation"] = round(($v[8] - $v[10]) / $v[10] * 100, 2); //涨跌幅
                }
                $value["code"] = $k; //代码
                $resultData[$k] = $value;
            }
            break;
		case "yatai":
			/*
			 * 亚太股指
			 * "b_NKY,b_TWSE,b_AS30,b_FSSTI"
			  0	指数名称
			  1	当前指数
			  2 涨跌量
			  3	涨跌幅
			  4	12小时时间
			  5	24小时时间

			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["name"] = $v[0]; //名称
				$value["new_price"] = $v[1]; //当前指数
				$value["fluctuation"] = $v[2]; //涨跌量
				$value["frice_fluctuation"] = $v[3]; //涨跌幅
				$value["time_12"] = $v[4]; //12小时时间
				$value["time_24"] = $v[5]; //24小时时间
				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;
        case "hengsheng":
            /*
             * 亚太股指
             * "b_NKY,b_TWSE,b_AS30,b_FSSTI"
              0	指数名称
              1	当前指数
              2 涨跌量
              3	涨跌幅
              4	12小时时间
              5	24小时时间

             *  */
            foreach ($data as $k => $v) {
                $k = strtolower($k);
                $value = array();
                $value["name"] = $v[1]; //名称
                $value["new_price"] = $v[6]; //当前指数
                $value["fluctuation"] = $v[7]; //涨跌量
                $value["frice_fluctuation"] = $v[8]; //涨跌幅

                $value["code"] = $k; //代码
                $resultData[$k] = $value;
            }
            break;

		case "ouzhou":
			/*
			 * 欧洲股指
			 * "b_CS90,b_PAX,b_FTSEMIB,b_ITLMS,b_ITMC,b_ITSTAR,b_IT30,b_BVLX,b_PSI20,b_ISEQ,b_ICEXI,b_HEX,b_HEX25,b_HEXP,b_HEXT,b_OBX,b_OBXP,b_OSEAX,b_OSEBX,b_OSEFX,b_OSESX,b_OMX,b_SBX,b_SAX,b_SE30,b_ATX,b_WBI,b_ATXPRIME,b_ASE,b_FTASE,b_FTSEM,b_FTSES,b_MALTEX,b_PFTS,b_BET,b_SKSM"
			  0	指数名称
			  1	当前指数
			  2 涨跌量
			  3	涨跌幅
			  4	行情时间
			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["name"] = $v[0]; //名称
				$value["new_price"] = $v[1]; //当前指数
				$value["fluctuation"] = $v[2]; //涨跌量
				$value["frice_fluctuation"] = $v[3]; //涨跌幅
				$value["date"] = $v[4]; //行情时间

				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;
		case "fund":
			/*
			 * 国内基金
			 * "f_392001,f_070008,f_000397,f_000540,f_000371,f_000638,f_000588,f_000464,f_000539,f_000730,f_000581,f_000600,f_000618,f_000343,f_000528,f_000575,f_519588,f_202301,f_202301,f_482002,f_000599,f_000009,f_750006,f_200003,f_530002,f_000379,f_162206,f_000569,f_000198,f_040038,f_000424,f_150005,f_000389,f_000641,f_180008,f_090005,f_000509,f_310338,f_000434,f_100025,f_020007,f_000331,f_320002,f_213009,f_003003,f_519505,f_460006,f_000300,f_519508,f_121011,f_000203,f_090022,f_161608,f_020031"
			  0	基金名称
			  1	万份收益
			  2 万份年化
			  3	行情时间
			  4	最新规模
			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["name"] = $v[0]; //基金名称
				$value["profit"] = $v[1]; //万份收益
				$value["annualized"] = $v[2]; //7日年化
				$value["date"] = $v[3]; //行情时间
				$value["new_scale"] = $v[4]; //最新规模

				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;
		case "option":
			/*
			 * 国内期权
			 * "CON_OP_10000898,CON_OP_10000892,CON_OP_10000893,CON_OP_10000894,CON_OP_10000895,CON_OP_10000896,CON_OP_10000900,CON_OP_10000916,CON_OP_10000924,CON_OP_10000932,CON_OP_10000952,CON_OP_10000960,CON_OP_10000968,CON_OP_10001126,CON_OP_10000984,CON_OP_10001090,CON_OP_10001008,CON_OP_10001091,CON_OP_10001038,CON_OP_10001092,CON_OP_10001046,CON_OP_10001093,CON_OP_10001094,CON_OP_10001054,CON_OP_10001062,CON_OP_10001068"
			  0	基金名称
			  1	万份收益
			  2 万份年化
			  3	行情时间
			  4	最新规模
			 *  */
			foreach ($data as $k => $v) {
				$k = strtolower($k);
				$value = array();
				$value["purchase_num"] = $v[0]; //买量
				$value["purchase_price"] = $v[1]; //买价
				$value["new_price"] = $v[2]; //最新价
				$value["selling_price"] = $v[3]; //卖价
				$value["settlement_num"] = $v[4]; //卖量
				$value["open_interest"] = $v[5]; //持仓量
				$value["frice_fluctuation"] = $v[6]; //涨跌幅
				$value["strike_price"] = $v[7]; //行情价
				$value["time"] = $v[32]; //时间
				$value["contract_name"] = $v[37]; //合约名称
				$value["amplitude"] = $v[38]; //振幅
				$value["code"] = $k; //代码
				$resultData[$k] = $value;
			}
			break;
		default :
			break;
	}
	return $resultData;
}
