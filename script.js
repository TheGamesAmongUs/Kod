function Sprawdz()
{


   checkbox=document.forms[1].elements[11];
   if(!checkbox.checked)
   {
      alert("Nie zaakceptowałeś regulaminu!");
      //dodatkowe akcje
      return false;
   }
   else
   {
      //dodatkowe akcje jeżeli zaznaczony
      return true;
   }

}
