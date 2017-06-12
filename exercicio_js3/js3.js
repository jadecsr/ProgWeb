document.grafico.botao.onclick = function () {
        var g1 = document.getElementById('graf1');
        var g2 = document.getElementById('graf2');
        var g3 = document.getElementById('graf3');
        var g4 = document.getElementById('graf4');
        var g5 = document.getElementById('graf5');
        var alt1 = document.getElementById('alt1');
        var alt2 = document.getElementById('alt2');
        var alt3 = document.getElementById('alt3');
        var alt4 = document.getElementById('alt4');
        var alt5 = document.getElementById('alt5');
        var larg = document.getElementById('larg');
        console.log(g1.width);
        g1.style.width = larg.value;
        console.log(g1.width);
        g1.style.height = alt1.value;
        g2.style.width = larg.value;
        g2.style.height = alt2.value;
        g3.style.width = larg.value;
        g3.style.height = alt3.value;
        g4.style.width = larg.value;
        g4.style.height = alt4.value;
        g5.style.width = larg.value;
        g5.style.height = alt5.value;
}