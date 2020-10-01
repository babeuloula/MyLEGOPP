/*
 Copyright 2014 My Lego Profil Pic. All rights reserved.
 */

function updateCoords(c) {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}

function checkCoords() {
    if (parseInt($('#w').val()) != 0) {
        return true;
    } else {
        alert("Veuillez sélectionner une zone à redimentionner");
        return false;
    }
}