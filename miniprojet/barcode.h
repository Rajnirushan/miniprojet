#ifndef __BC__

#define __BC__

#include <system.hpp>
#include <printers.hpp>

class barcode
{
private:

    AnsiString partial;
    AnsiString textinfo;
    AnsiString encoding;
    TPrinter* printObj;

    void encode();
    void print();

    AnsiString ascii;
    AnsiString titre;
    int xoff, yoff;
    int margin;
    int height;
    int scalef;

    int gauche;
    int droite;
    int haut;
    int bas;

    int fontSize;
    int textOffset;

public:
    barcode();
    
    void encode_and_print();

    void setScale(int);
    int getScale();

    void setHeight(int);
    int getHeight();

    void setTitre(AnsiString);
    AnsiString getTitre();

    void setAscii(AnsiString);
    AnsiString getAscii();

    void startPrint();
    void endPrint();

    void setX(int);
    int getX();

    void setY(int);
    int getY();

    void setGauche(int);
    int getGauche();

    void setDroite(int);
    int getDroite();

    void setHaut(int);
    int getHaut();

    void setBas(int);
    int getBas();

    void setFontSize(int);
    void setTextOffset(int);
};

#endif
