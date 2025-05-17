function evalua(oNombre, oTelefono, oDireccion, oEmail) {
    var sErr = "";
    var bRet = false;

    if (oNombre.disabled == false && oNombre.value.trim() == "")
        sErr += "\nFalta nombre";

    if (oTelefono.disabled == false && oTelefono.value.trim() == "")
        sErr += "\nFalta teléfono";

    if (oDireccion.disabled == false && oDireccion.value.trim() == "")
        sErr += "\nFalta dirección";

    if (oEmail.disabled == false && oEmail.value.trim() == "")
        sErr += "\nFalta email";

    if (sErr == "")
        bRet = true;
    else
        alert(sErr);

    return bRet;
}