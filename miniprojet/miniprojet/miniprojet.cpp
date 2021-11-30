#include "Windows.h"
#include <shellapi.h>
#include <tchar.h>

#include <iostream>
using namespace std;
int main()
{
	//string URL = "http://www.google.fr";
	string URL = "localhost/projetSante/code.php";

	string id;
	cout << "scanner qrcode " << endl;
	cin >> id;
	//cout <<"id:"<< id;
	URL = URL + "?identifiant=" +id;
	cout << URL << endl;

	ShellExecuteA(NULL, "open", URL.c_str(), NULL, NULL, SW_SHOWNORMAL); //ouvre navigateur avec l'url
}



