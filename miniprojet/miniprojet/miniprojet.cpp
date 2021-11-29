
#include <iostream>

int main()
{
    barcode bCode; // déclaration objet
    bCode.setX(100); // 100 pixels depuis la gauche sinon
    // le barcode sort de la feuille imprimée
    bCode.setY(100); // --- même commentaire
    bCode.setFontSize(5);
    bCode.setScale(3);
    bCode.setTitre("CodeBarre"); // Titre du code barre ("désignation")
    bCode.setAscii("4865154845125472525");// Code en lui-même
    bCode.startPrint(); // début impression
    bCode.encode_and_print(); // encodage code et impression
    bCode.endPrint(); // fin d'impression




}

