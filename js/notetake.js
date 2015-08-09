﻿$(document).ready(function () {
    // focus on the input
    var textInput = $("#note-input");
    textInput.focus();

    var currentColor = 0;
    var colors = {};
    colors["black"] = "#000000";
    colors["blue"] = "#0094ff";
    colors["green"] = "#299228";
    colors["red"] = "#ba1d1d";
    colors["orange"] = "#ed8a00";
    
    // literal array to store the color hex values
    colorsArr = [];
    for (var key in colors) {
        if (colors.hasOwnProperty(key)) {
            colorsArr.push(colors[key]);
        }
    }

    $(document).keyup(function(event) {
        if (event.which === 13) { // enter pressed
            console.log("enter pressed\n");
            $("#note-list").append("<li style=\"color:" + colorsArr[currentColor] + "\">" + textInput.val() + "</li>");
            textInput.val('');
        }
    });

    $(document).keydown(function (event) {
        if (event.which === 18) {
            console.log("alt pressed down");
            // cycling through colors
            $(document).keydown(function (event) {
                if (event.which === 16) {
                    console.log("shift pressed down");
                    currentColor = currentColor >= colorsArr.length - 1 ? 0 : ++currentColor;
                    console.log("colorsArr length:" + colorsArr.length);
                    console.log("current color:" + currentColor);
                    textInput.css("color", colorsArr[currentColor]);
                    console.log(colorsArr[currentColor]);
                }
            });

            $(document).keydown(function (event) {
                if (event.which === 49) {
                    currentColor = 0;
                    textInput.css("color", colorsArr[currentColor]);
                }
            });

            $(document).keydown(function (event) {
                if (event.which === 50) {
                    currentColor = 1;
                    textInput.css("color", colorsArr[currentColor]);
                }
            });

            $(document).keydown(function (event) {
                if (event.which === 51) {
                    currentColor = 2;
                    textInput.css("color", colorsArr[currentColor]);
                }
            });

            $(document).keydown(function (event) {
                if (event.which === 52) {
                    currentColor = 3;
                    textInput.css("color", colorsArr[currentColor]);
                }
            });

            $(document).keydown(function (event) {
                if (event.which === 53) {
                    currentColor = 4;
                    textInput.css("color", colorsArr[currentColor]);
                }
            });
        }
    });
});