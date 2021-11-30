#include "barcode.h"
//---------------------------------------------------------------------------

AnsiString codeset[] = {
    "212222", "222122", "222221", "121223", "121322",  /*  0 -  4 */
    "131222", "122213", "122312", "132212", "221213",
    "221312", "231212", "112232", "122132", "122231",  /* 10 - 14 */
    "113222", "123122", "123221", "223211", "221132",
    "221231", "213212", "223112", "312131", "311222",  /* 20 - 24 */
    "321122", "321221", "312212", "322112", "322211",
    "212123", "212321", "232121", "111323", "131123",  /* 30 - 34 */
    "131321", "112313", "132113", "132311", "211313",
    "231113", "231311", "112133", "112331", "132131",  /* 40 - 44 */
    "113123", "113321", "133121", "313121", "211331",
    "231131", "213113", "213311", "213131", "311123",  /* 50 - 54 */
    "311321", "331121", "312113", "312311", "332111",
    "314111", "221411", "431111", "111224", "111422",  /* 60 - 64 */
    "121124", "121421", "141122", "141221", "112214",
    "112412", "122114", "122411", "142112", "142211",  /* 70 - 74 */
    "241211", "221114", "413111", "241112", "134111",
    "111242", "121142", "121241", "114212", "124112",  /* 80 - 84 */
    "124211", "411212", "421112", "421211", "212141",
    "214121", "412121", "111143", "111341", "131141",  /* 90 - 94 */
    "114113", "114311", "411113", "411311", "113141",
    "114131", "311141", "411131", "b1a4a2", "b1a2a4",  /* 100 - 104 */
    "b1a2c2", "b3c1a1b"
};
//---------------------------------------------------------------------------


void barcode::encode()
{
    int i, code, textpos = 11;
    int checksum = 104;

    partial = "0b1a2a4";
    textinfo = "";
    encoding = "code 128-B";

    for (int i = 0; i < ascii.Length(); i++)
    {
        code = ascii[i+1] - 32;
        partial += codeset[code];
        checksum += code * (i+1);
        textinfo += IntToStr(textpos) + ':12:';
        textinfo += ascii[i+1] + ' ';
        textpos += 11;
    }

    checksum %= 103;
    partial += codeset[checksum];
    partial += codeset[106];
}
//---------------------------------------------------------------------------

void barcode::print()
{
    int barlen = 0, j;
    double scaleg, x0, y0, yr, xpos = 0;


    for (int i = 1; i < partial.Length(); i++)
    {
        if (partial[i+1] >= '0' && partial[i+1] <= '9')
        {
            barlen += partial[i+1] - '0';
        }
        else
        {
            barlen += partial[i+1] - 'a' + 1;
        }
    }


    for (int i=1; i < partial.Length(); i++)
    {
        if (partial[i+1] >= '0' && partial[i+1] <= '9')
        {
            j = (partial[i+1] - '0') * scalef;
        }
        else
        {
            j = (partial[i+1] - 'a' + 1) * scalef;
        }

        if (i % 2)
        {
            x0 = xoff + xpos + j / 2;
            y0 = yoff; // + 50;
            yr = height;

           printObj->Canvas->MoveTo(this->gauche + x0, this->haut + y0);
           printObj->Canvas->Pen->Width = j;
           printObj->Canvas->LineTo(this->gauche + x0, this->haut + y0 + yr);

        }
        xpos = xpos + j;
    }

    // Efface les bords haut et droit du code barre
    printObj->Canvas->Font->Size = 8; //this->fontSize;

    char szBlanc[10240];
    memset(szBlanc, 0, sizeof(szBlanc));
    memset(szBlanc, ' ', int(xpos)); // Place les espaces
    printObj->Canvas->TextOutA(this->gauche + xoff, this->haut + yoff - 30, szBlanc);
    printObj->Canvas->TextOutA(this->gauche + xoff, this->haut + yoff + height, szBlanc);

    // Affiche le numéro du code barre en bas
    printObj->Canvas->Font->Size = this->fontSize;
    printObj->Canvas->TextOutA(this->gauche + xoff, this->haut + yoff + height, ascii);
/*    printObj->Canvas->Font->Size = 4;
    printObj->Canvas->TextOutA(this->gauche + xoff + 250, this->haut + yoff + height, "Point Vidéo - Frameries");
*/
    // Affiche le titre associé au code barre
    printObj->Canvas->Font->Size = 7; //this->fontSize;
    printObj->Canvas->TextOutA(this->gauche + xoff, this->haut + yoff + height + 50, titre);
}
//---------------------------------------------------------------------------

barcode::barcode()
{
    this->scalef = 5;
    this->height = 110;
    this->fontSize = 10;

    this->gauche = 10;
    this->droite = 50;
    this->haut = 10;
    this->bas = 30;

    this->textOffset = 0;
}
//---------------------------------------------------------------------------

void barcode::setScale(int scalef)
{
    this->scalef = scalef;
}
//---------------------------------------------------------------------------

int barcode::getScale()
{
    return this->scalef;
}
//---------------------------------------------------------------------------

void barcode::setHeight(int height)
{
    this->height = height;
}
//---------------------------------------------------------------------------

int barcode::getHeight()
{
    return this->height;
}
//---------------------------------------------------------------------------

void barcode::setTitre(AnsiString titre)
{
    this->titre = titre;
}
//---------------------------------------------------------------------------

AnsiString barcode::getTitre()
{
    return this->titre;
}
//---------------------------------------------------------------------------

void barcode::setAscii(AnsiString ascii)
{
    this->ascii = ascii;
}
//---------------------------------------------------------------------------

AnsiString barcode::getAscii()
{
    return this->ascii;
}
//---------------------------------------------------------------------------

void barcode::startPrint()
{
    printObj = Printer();
    printObj->BeginDoc();
}
//---------------------------------------------------------------------------

void barcode::endPrint()
{
    printObj->EndDoc();
    printObj = 0;
}
//---------------------------------------------------------------------------

void barcode::setX(int xoff)
{
    this->xoff = xoff;
}
//---------------------------------------------------------------------------

int barcode::getX()
{
    return this->xoff;
}
//---------------------------------------------------------------------------

void barcode::setY(int yoff)
{
    this->yoff = yoff;
}
//---------------------------------------------------------------------------

int barcode::getY()
{
    return this->yoff;
}
//---------------------------------------------------------------------------

void barcode::encode_and_print()
{
    encode();
    print();
}
//---------------------------------------------------------------------------

void barcode::setGauche(int marge)
{
    this->gauche = marge;
}
//---------------------------------------------------------------------------

int barcode::getGauche()
{
    return this->gauche;
}
//---------------------------------------------------------------------------

void barcode::setDroite(int marge)
{
    this->droite = marge;
}
//---------------------------------------------------------------------------

int barcode::getDroite()
{
    return this->droite;
}
//---------------------------------------------------------------------------

void barcode::setHaut(int marge)
{
    this->haut = marge;
}
//---------------------------------------------------------------------------

int barcode::getHaut()
{
    return this->haut;
}
//---------------------------------------------------------------------------

void barcode::setBas(int marge)
{
    this->bas = marge;
}
//---------------------------------------------------------------------------

int barcode::getBas()
{
    return this->bas;
}
//---------------------------------------------------------------------------

void barcode::setFontSize(int size)
{
    this->fontSize = size;
}
//---------------------------------------------------------------------------

void barcode::setTextOffset(int offset)
{
    this->textOffset = offset;
}
//---------------------------------------------------------------------------


