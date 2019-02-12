#ifndef __HQ_API_H
#define __HQ_API_H

#include <Windows.h>

#ifdef __cplusplus
extern "C" {
#endif

//1.����API����TdxHqApi.dll�ļ��ĵ����������������º�����(�������麯����Ϊ�ͻ������������ѯ�����Ƿ���������)
//bool  TdxHq_Connect(char* IP, int Port, char* Result, char* ErrInfo);//����ȯ�����������
//void  TdxHq_Disconnect();//�Ͽ�������
//bool  TdxHq_GetSecurityCount(byte Market, short& Result, char* ErrInfo);//��ȡָ���г��ڵ�֤ȯ��Ŀ
//bool  TdxHq_GetSecurityList(byte Market, short Start, short& Count, char* Result, char* ErrInfo);//��ȡ�г���ָ����Χ�ڵ�����֤ȯ����
//bool  TdxHq_GetSecurityQuotes(byte Market[], char* Zqdm[], short& Count, char* Result, char* ErrInfo);//��ȡ�̿��嵵����
//bool  TdxHq_GetSecurityBars(byte Category, byte Market, char* Zqdm, short Start, short& Count, char* Result, char* ErrInfo);//��ȡ��ƱK��
//bool  TdxHq_GetIndexBars(byte Category, byte Market, char* Zqdm, short Start, short& Count, char* Result, char* ErrInfo);//��ȡָ��K��
//bool  TdxHq_GetMinuteTimeData(byte Market, char* Zqdm, char* Result, char* ErrInfo);//��ȡ��ʱͼ����
//bool  TdxHq_GetHistoryMinuteTimeData(byte Market, char* Zqdm, int date, char* Result, char* ErrInfo);//��ȡ��ʷ��ʱͼ����
//bool  TdxHq_GetTransactionData(byte Market, char* Zqdm, short Start, short& Count, char* Result, char* ErrInfo);//��ȡ��ʱ�ɽ�
//bool  TdxHq_GetHistoryTransactionData(byte Market, char* Zqdm, short Start, short& Count, int date, char* Result, char* ErrInfo);//��ȡ��ʷ��ʱ�ɽ�
//bool  TdxHq_GetCompanyInfoCategory(byte Market, char* Zqdm, char* Result, char* ErrInfo);//��ȡF10��Ϣ���
//bool  TdxHq_GetCompanyInfoContent(byte Market, char* Zqdm, char* FileName, int Start, int Length, char* Result, char* ErrInfo);//��ȡF10��Ϣ����
//bool  TdxHq_GetXDXRInfo(byte Market, char* Zqdm, char* Result, char* ErrInfo);//��ȡȨϢ����
//bool  TdxHq_GetFinanceInfo(byte Market, char* Zqdm, char* Result, char* ErrInfo);//��ȡ��������

bool WINAPI TdxHq_Connect(
    const char *pszIP,
    short nPort,
    char *pszResult,
    char *pszErrInfo);

/*
bool WINAPI TdxHq_Reconnect(
    char *pszResult,
    char *pszErrInfo);
*/

void WINAPI TdxHq_Disconnect();

void WINAPI TdxHq_SetTimeout(
    int nReadTimeout,
    int nWriteTimeout);

bool WINAPI TdxHq_GetSecurityCount(
    char nMarket,
    short *nCount,
    char *pszErrInfo);

bool WINAPI TdxHq_GetSecurityList(
    char nMarket,
    short nStart,
    short *nCount,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetSecurityQuotes(
    const char nMarket[],
    const char *pszZqdm[],
    short *nCount,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_VB_GetSecurityQuotes(
    const char nMarket[],
    VARIANT VBpStrArray,
    short *nCount,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetSecurityBars(
    char nCategory,
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *nCount,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetIndexBars(
    char nCategory,
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *nCount,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetMinuteTimeData(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetHistoryMinuteTimeData(
    char nMarket,
    const char *pszZqdm,
    int nDate,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetTransactionData(
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *nCount,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetHistoryTransactionData(
    char nMarket,
    const char *pszZqdm,
    short nStart,
    short *nCount,
    int date,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetCompanyInfoCategory(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetCompanyInfoContent(
    char nMarket,
    const char *pszZqdm,
    const char *pszFileName,
    int nStart,
    int nLength,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetXDXRInfo(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

bool WINAPI TdxHq_GetFinanceInfo(
    char nMarket,
    const char *pszZqdm,
    char *pszResult,
    char *pszErrInfo);

#ifdef __cplusplus
}
#endif

#endif
