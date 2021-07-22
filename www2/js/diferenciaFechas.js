function diferenciaFechas(sFechaDesde, sFechaHasta, sFormato, sSeparator, bIncludeYears, bDebug)

{

    bIncludeYears = (bIncludeYears ? true : false);

    sSeparator = (sSeparator ? sSeparator : '/');

    bDebug = ((bDebug ? true : false) ? (console ? true : false) : false);

    var aFecha1, aFecha2, diff;

    var oFormato = eval('({"yyyy": 0,"mm": 1,"dd": 2})');



    if (bIncludeYears)

        var oReturn = eval('({"days": 0, "months": 0, "years": 0, "from":"' + sFechaDesde + '", "until":"' + sFechaHasta + '"})');

    else

        var oReturn = eval('({"days": 0, "months": 0            , "from":"' + sFechaDesde + '", "until":"' + sFechaHasta + '"})');



    // Formato

    if (!sFormato)

    {

        sFormato = 'dd/mm/yyyy';

    }

    else

    {

        var aFormato = sFormato.split(sSeparator);

        for(iPos in  aFormato)

        {

            eval('oFormato.' + aFormato[iPos] + ' = ' + String(iPos));

            iPos++;

        }

    }

    if (bDebug) console.log('Formato: ' + sFormato, aFormato, oFormato);



   



    // Date validity

    var aFechaDesde = sFechaDesde.split('-');

    var iDesdeDD = parseInt(aFechaDesde[oFormato.dd  ], 10);

    var iDesdeMM = parseInt(aFechaDesde[oFormato.mm  ], 10);

    var iDesdeYY = parseInt(aFechaDesde[oFormato.yyyy], 10);



    if (bDebug) console.log('Fecha Desde - Array - DD MM YYYY: ', aFechaDesde, iDesdeDD, iDesdeMM, iDesdeYY);



    var aFechaHasta = sFechaHasta.split('-');

    var iHastaDD = parseInt(aFechaHasta[oFormato.dd  ], 10);

    var iHastaMM = parseInt(aFechaHasta[oFormato.mm  ], 10);

    var iHastaYY = parseInt(aFechaHasta[oFormato.yyyy], 10);



    if (bDebug) console.log('Fecha Hasta - Array - DD MM YYYY: ', aFechaHasta, iHastaDD, iHastaMM, iHastaYY);



    // mismo año y mes

    if (iDesdeYY == iHastaYY && iDesdeMM == iHastaMM)

    {

        oReturn.months = 0;

        if (bDebug) console.log('mismo año y mismo mes');

    }

    // mismo año y distinto mes

    else if (iDesdeYY == iHastaYY && iDesdeMM != iHastaMM)

    {

        oReturn.months = (iHastaMM - iDesdeMM);

        if (bDebug) console.log('mismo año y distinto mes');

    }

    // distinto año

    else

    {

        // Meses de diferencia por años

        oReturn.months = ((iHastaYY - iDesdeYY) * 12);



        // Meses de diferencia en el año coincidente

        if (iHastaMM > iDesdeMM)

            oReturn.months += (iHastaMM - iDesdeMM);

        else

            oReturn.months += (iHastaMM + (12 - iDesdeMM) - 12);



        if (bDebug) console.log('distinto año');

    }



    // Años

    if (bIncludeYears)

    {

        if (bDebug) console.log('Calcula los años');

        oReturn.years  = Math.floor(oReturn.months / 12);

        oReturn.months -= oReturn.years * 12;

    }



    // Dias de diferencia

    // hasta es mayor o igual

    if (iHastaDD >= iDesdeDD)

    {

        oReturn.days = iHastaDD - iDesdeDD;

        if (bDebug) console.log('Dias de diferencia -> Dia hasta es mayor o igual');

    }



    // hasta es menor

    else

    {

        if (oReturn.months) oReturn.months--;

        var dd = new Date(iHastaYY, (iHastaMM - 1), 0); // El mes empieza en 0

        var iDiasMesAnterior = dd.getDate();

        oReturn.days = iHastaDD + iDiasMesAnterior - iDesdeDD;

        if (bDebug) console.log('iHastaDD + iDiasMesAnterior - iDesdeDD: ', iHastaDD, iDiasMesAnterior, iDesdeDD);

        if (bDebug) console.log('Dias de diferencia -> Dia hasta es menor, se restan meses');

    }



    if (bDebug) console.log('Se retorna: ', oReturn);

    return oReturn;



}