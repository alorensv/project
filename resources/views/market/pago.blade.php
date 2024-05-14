<style>
   .botonContinuarTransbank {
      border: 1px solid #6b196b;
      border-radius: 4px;
      background-color: #6b196b;
      color: #fff;
      font-family: Roboto, Arial, Helvetica, sans-serif;
      font-size: 1.14rem;
      font-weight: 500;
      margin: auto 0 0;
      padding: 12px;
      position: relative;
      text-align: center;
      -webkit-transition: .2s ease-in-out;
      transition: .2s ease-in-out;
      max-width: 200px;
   }

   .container {
      height: 200px;
      position: relative;
      text-align: center;

   }

   .vertical-center {
      margin-top: 20%;
      /*margin: 0;
              position: absolute;
              top: 50%;
              -ms-transform: translateY(-50%);
              transform: translateY(-50%);*/
   }

   .lds-hourglass {
      display: inline-block;
      position: relative;
      width: 80px;
      height: 80px;
   }

   .lds-hourglass:after {
      content: " ";
      display: block;
      border-radius: 50%;
      width: 0;
      height: 0;
      margin: 8px;
      box-sizing: border-box;
      border: 32px solid purple;
      border-color: purple transparent purple transparent;
      animation: lds-hourglass 1.2s infinite;
   }

   @keyframes lds-hourglass {
      0% {
         transform: rotate(0);
         animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
      }

      50% {
         transform: rotate(900deg);
         animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
      }

      100% {
         transform: rotate(1800deg);
      }
   }
</style>

<?php

/**
 * @author     Cristian Cisternas.
 * @copyright  2021 Brouter SpA (https://www.brouter.cl)
 * @date       Agoust 2021
 * @license    GNU LGPL
 * @version    1.0.1
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>

<div class="container">
      <div class="vertical-center">
         <div class="lds-hourglass"></div>
         <img src="/img/WebpayPlus_FB_300px.png">
         <!-- <p><?php //echo $message; ?></p> -->
         <?php if (strlen($url_tbk)) { ?>
            <form name="brouterForm" id="brouterForm" method="POST" action="<?= $url_tbk ?>" style="display:block;">
               @csrf
               <input type="hidden" name="token_ws" value="<?= $token ?>" />
            </form>
            <script>
               var auto_refresh = setInterval(
                  function() {
                     submitform();
                  },1000);
               //}, 5000);
               function submitform() {
                  //alert('test');
                  document.brouterForm.submit();
               }
            </script>
         <?php } ?>
      </div>
   </div>