#ifndef __EXHQ_API_H
#define __EXHQ_API_H

#include <Windows.h>

#ifdef __cplusplus
extern "C" {
#endif

//
// ����API����TdxHqApi.dll�ļ��ĵ����������������麯����Ϊ�ͻ������������ѯ�����Ƿ���������
//


//
// ����ȯ�����������
//
bool WINAPI TdxExHq_Connect(
    const char *pszIP,
    short nPort,
    char *pszResult,
    char *pszErrInfo);

//
// �Ͽ�������
//
void WINAPI TdxExHq_Disconnect();

//
//
//
void WINAPI TdxExHq_SetTimeout(
    int nReadTimeout,
    int nWriteTimeout);

//
//
// ��ȡ��չ������֧�ֵĸ����г����г�����
//
// <param name="Result">��APIִ�з��غ�Result�ڱ����˷��صĲ�ѯ����, ��ʽΪ������ݣ�������֮��ͨ��\n�ַ��ָ������֮��ͨ��\t�ָ���һ��Ҫ����1024*1024�ֽڵĿռ䡣����ʱΪ���ַ�����</param>
// <param name="ErrInfo">��APIִ�з��غ�������������˴�����Ϣ˵����һ��Ҫ����256�ֽڵĿռ䡣û����ʱΪ���ַ�����</param>
//
bool WINAPI TdxExHq_GetMarkets(
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡ����Ʒ�ֵ���Ŀ
//
bool WINAPI TdxExHq_GetInstrumentCount(
    int *nCount,
    char *pszErrInfo);

//
// ��ȡ����Ʒ�ִ���
//
bool WINAPI TdxExHq_GetInstrumentInfo(
    int nStart,
    short* pnCount,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡָ��Ʒ�ֵ��̿ڱ���
//
bool WINAPI TdxExHq_GetInstrumentQuote(
    char nMarket,
    const char* pszZqdm,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡָ��Ʒ�ֵ�K������
//
bool WINAPI TdxExHq_GetInstrumentBars(
    char nCategory,
    char nMarket,
    const char* pszZqdm,
    int nStart,
    short* pnCount,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡָ��Ʒ�ֵķ�ʱͼ����
//
bool WINAPI TdxExHq_GetMinuteTimeData(
    char nMarket,
    const char* pszZqdm,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡָ��Ʒ�ֵķ�ʱͼ����
//
bool WINAPI TdxExHq_GetHistoryMinuteTimeData(
    char nMarket,
    const char* pszZqdm,
    int nDate,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡָ��Ʒ�ֵķ�ʱ�ɽ�����
//
bool WINAPI TdxExHq_GetTransactionData(
    char nMarket,
    const char* pszZqdm,
    int nStart,
    short* pnCount,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡָ��Ʒ�ֵ���ʷ��ʱ�ɽ�����
//
bool WINAPI TdxExHq_GetHistoryTransactionData(
    char nMarket,
    const char* pszZqdm,
    int nDate,
    int nStart,
    short* pnCount,
    char* pszResult,
    char* pszErrInfo);

#ifdef __cplusplus
}
#endif

#endif
