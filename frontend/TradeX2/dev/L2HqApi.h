#ifndef __L2HQ_API_H
#define __L2HQ_API_H

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
bool WINAPI TdxL2Hq_Connect(
    const char *pszIP,
    short nPort,
    const char *pszL2User,
    const char *pszL2Password,
    char *pszResult,
    char *pszErrInfo);

//
// �Ͽ�������
//
void WINAPI TdxL2Hq_Disconnect();

//
//
//
void WINAPI TdxL2Hq_SetTimeout(
    int nReadTimeout,
    int nWriteTimeout);

//
// ��ȡָ���г��ڵ�֤ȯ��Ŀ
//
bool WINAPI TdxL2Hq_GetSecurityCount(
    char nMarket,
    short *pnCount,
    char *pszErrInfo);

//
// ��ȡ�г���ָ����Χ�ڵ�����֤ȯ����
//
bool WINAPI TdxL2Hq_GetSecurityList(
    char nMarket,
    short nStart,
    short *pnCount,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡ�̿��嵵����
//
bool WINAPI TdxL2Hq_GetSecurityQuotes(
    const char nMarket[],
    const char *pszZqdm[],
    short *pnCount,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxL2Hq_VB_GetSecurityQuotes(
    const char nMarket[],
    VARIANT VBpStrArray,
    short *nCount,
    char *pszResult,
    char *pszErrInfo);


//
// ��ȡ��ƱK��
//
bool WINAPI TdxL2Hq_GetSecurityBars(
    char nCategory,
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *pnCount,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡָ��K��
//
bool WINAPI TdxL2Hq_GetIndexBars(
    char nCategory,
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *pnCount,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡ��ʱͼ����
//
bool WINAPI TdxL2Hq_GetMinuteTimeData(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

//
//��ȡ��ʷ��ʱͼ����
//
bool WINAPI TdxL2Hq_GetHistoryMinuteTimeData(
    char nMarket,
    const char *pszZqdm,
    int nDate,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡ��ʱ�ɽ�
//
bool WINAPI TdxL2Hq_GetTransactionData(
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *pnCount,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡ��ʷ��ʱ�ɽ�
//
bool WINAPI TdxL2Hq_GetHistoryTransactionData(
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *pnCount,
    int date,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡF10��Ϣ���
//
bool WINAPI TdxL2Hq_GetCompanyInfoCategory(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡF10��Ϣ����
//
bool WINAPI TdxL2Hq_GetCompanyInfoContent(
    char nMarket,
    const char *pszZqdm,
    const char *pszFileName,
    int nStart,
    int nLength,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡȨϢ����
//
bool WINAPI TdxL2Hq_GetXDXRInfo(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡ��������
//
bool WINAPI TdxL2Hq_GetFinanceInfo(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡʮ������
//
bool WINAPI TdxL2Hq_GetSecurityQuotes10(
    const char nMarket[],
    const char *pszZqdm[],
    short *pnCount,
    char* pszResult,
    char* pszErrInfo);

bool WINAPI TdxL2Hq_VB_GetSecurityQuotes10(
    const char nMarket[],
    VARIANT VBpStrArray,
    short *nCount,
    char *pszResult,
    char *pszErrInfo);

//
// ��ȡ��ʳɽ�(�Ӻ���ǰ)
//
bool WINAPI TdxL2Hq_GetDetailTransactionData(
    char nMarket,
    const char *pszZqdm,
    int nStart,
    short *pnCount,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡ��ʳɽ�(��ǰ����)
//
bool WINAPI TdxL2Hq_GetDetailTransactionDataEx(
    char nMarket,
    const char *pszZqdm,
    int nStart,
    short *pnCount,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡ���ί��(�Ӻ���ǰ)
//
bool WINAPI TdxL2Hq_GetDetailOrderData(
    char nMarket,
    const char *pszZqdm,
    int nStart,
    short *pnCount,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡ���ί��(��ǰ����)
//
bool WINAPI TdxL2Hq_GetDetailOrderDataEx(
    char nMarket,
    const char *pszZqdm,
    int nStart,
    short *pnCount,
    char* pszResult,
    char* pszErrInfo);

//
// ��ȡʮ������
//
bool WINAPI TdxL2Hq_GetBuySellQueue(
    char nMarket,
    const char* pszZqdm,
    char* pszResult,
    char* pszErrInfo);

#ifdef __cplusplus
}
#endif

#endif
