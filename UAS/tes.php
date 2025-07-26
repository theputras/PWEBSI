<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Form Pendaftaran</title>
        <link rel="stylesheet" href="/assets/css/stylePendaftaran.css">
        <link rel="shortcut icon" href="/assets/DaisekoiLogoBg.png" style="border-radius: 100%;" type="image/jpg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/montreal" type="text/css"/>
        
        <style>
        
        
@import 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css';
@import url('https://fonts.cdnfonts.com/css/helvetica-neue-5');

*,
*::before,
*::after {
  box-sizing: border-box;
}
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
#error-message {
  display: none; 
  color: red;
  font-size: 14px;
  margin-top: 5px;
  text-align: center;
  flex-direction: column;
  justify-content: center;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  min-height: 600px;
  font-weight: 800;
  text-align: center;
}

html {
    min-height: -80vh;
}
body{
    font-family: 'Helvetica Neue', sans-serif !important;   
    background: linear-gradient(-21.11deg, #00c0fa 30%, #015eea);
    background-size: 100% 100vh;
    background-attachment: fixed; /* add this line */
    height: 100vh;
    overflow-y: auto; /* add a scrollbar if the content exceeds the height */
}   


a {
    color: #5ce6ff !important;
    text-decoration: none !important;
    background-color: transparent;
}

.form-hidden {
    display: none;
  }

input ::placeholder {
    word-wrap: break-word; /* Ensures long words will wrap*/
}
/* Example of other elements in the form */
.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
}

.form-group label {
  font-weight: 600;
  margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.container {
  max-width: 1200px; /* adjust the max-width to your liking */
  margin: 0 auto;
  padding: 20px;
  margin-bottom: 50px; /* add some space between the form container and the footer */
   min-height: calc(100vh - 100px); /* adjust the value to push the footer down */
}

.container.form-container,.container.output-container {
  height: 100vh;
  width: 100%; /* add this to take up full width */
  max-width: 1200px; /* adjust the max-width to your liking */
  margin: 0 auto; /* add this to center the elements */
  padding: 20px; /* add some padding for better layout */
}

.form-container, .output-container, #error-message {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 51px;
  padding: 20px;
}

/* Add Bootstrap classes to center the sections */
.form-container, .output-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column-reverse;
}

#Formulir1, #Formulir2 {
  background: linear-gradient(-21.11deg, #00c0fa 30%, #015eea);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  min-width:61vw;
}

.output-container {
  background: linear-gradient(-21.11deg, #015eea 30%,  #00c0fa);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  padding: 20px !important;
}

.icon .img-bg {
    height: 200px;
    width:fit-content;
    position: absolute;
}

.form-left{

    display: flex;
    flex-direction: column;
    align-items: start;
    gap: 20px;
}
/* Alert */

 #alert1, #alert2, #alert3, #alertback, #alerthapus1, #alerthapus2{
  color:#ec0064;
  display: none;
 }

/* Transition effect */
.form-left, .form-right img, .output-container {
    opacity: 0;
    transform: translateY(50%);
    transition: opacity 0.5s, transform 0.5s;
  }
  
  .form-left.show, .form-right img.show, .output-container.show {
    opacity: 1;
    transform: translateY(0);
  }


#Formulir1.show, #Formulir2.show {

  opacity: 1;
  transform: translateY(0);
}
  
.footer {
  opacity: 0;
  transition: opacity 0.5s; /* add transition effect */
}

.footer.show {
  opacity: 1;
  transition: opacity 0.5s; /* add transition effect */
}

/*.footer .container {
    position: relative;
    bottom: 0;
    display: flex;
  flex-wrap: nowrap;
  flex-direction: row;
  align-items: center;
  width: 100%;
  padding: 1px 1px 1px 1px; /* Reduced padding 
  min-height: calc(1vh - 1px); /* 90px adalah tinggi footer
} 
*/
.form-right-load {
  position: fixed;
  display: flex;
    flex-direction: column;
    align-items: center;
    flex-wrap: wrap;
    justify-content: center;
    align-content: center;;
 }

 .form-left, .form-right {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
  padding: 20px;
}
#loadingIndicator {
  position: relative;
  flex-direction: column;
  align-items: start;
  flex-wrap: wrap;
  justify-content: center;
  align-content: center;
}


#loadingIndicator svg, #loadingIndicator2 svg {
  width: 80px;
  height: 80px;
  position: relative;
  animation: rotate 2s linear infinite;
}

@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

#loadingIndicator svg circle, #loadingIndicator2 svg circle {
  width: 80px;
  height: 80px;
  cx: 40;
  cy: 40;
  r: 35;
  fill: none;
  stroke-width: 6;
  stroke: #015eea;
  stroke-linecap: round;
  transform: translate(0, 0); /* removed translate */
  stroke-dasharray: 240; /* updated stroke-dasharray */
  stroke-dashoffset: 240; /* updated stroke-dashoffset */
  animation: animate 4s linear infinite;
}

@keyframes animate {
  0%, 100% {
    stroke-dashoffset: 360;
  }
  50% {
    stroke-dashoffset: 0;
  }
  50.1% {
    stroke-dashoffset: 720;
  }
}
.main-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
.footer {
  display: flex;

  min-height: 0;
  position: relative;
  bottom: 0;
  width: 100%;
  background-color: #015eea;
  padding: 20px 0;
  text-align: center;
  color: #fff;
  
}
.form-container, .container {
  flex: 1;
}

#form, #output {
min-height: 600px;

}
footer {
  display: block;
  height: 50px; /* adjust the height to your liking */  
}
.footer-container {
  display: flex;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: space-between;

  min-height: 0;
  max-width: 1200px; /* adjust the max-width to your liking */
  margin: 0 auto;
  padding:0 0 0 20px;
}
.logo-footer {
display: none;
}



.footer.logo-footer {
  display: block;
  width: 100px;
  height: auto;
  margin: 10px;
}

.footer p {
 margin: 0;
 text-align: start;
 word-wrap: break-word; /* Ensures long words will wrap */
 font-size: calc(0.4rem + 0.5vw);
 color: #fff;
}


.input-group-text {
  display: flex !important;
  align-items: center !important;
  padding: .375rem .75rem !important;
  font-size: 1rem !important;
  font-weight: 400 !important;
  line-height: 1.5 !important;
  color: var(--bs-body-color) !important;
  text-align: center !important;
  white-space: nowrap !important;
  background-color: #00c0fa !important;
  border: var(--bs-border-width) solid #015eea !important;
  border-radius: var(--bs-border-radius) !important;
}

.form-label, .form-text{
color: #ffffff !important;
}
.form-left-title {
  text-align: left;
    margin-bottom: 20px;
    max-width: 100%; /* Ensures the title container doesn't exceed its parent's width */
}

.form-left-title h2 {
    font-weight: 500;
    color: #ffffff;
    font-size: 4vh;
    margin-bottom: 5px;
    word-wrap: break-word; /* Ensures long words will wrap */
}

#text-container {
    overflow: hidden; /* hide excess text */
    text-overflow: ellipsis; /* add ellipsis at the end */
    max-width: 100vh; /* adjust the width to your liking */
    font-weight: 800;
    text-align: center;
    color: #ffffff;
    font-size: 4vh;
    margin: 100px 0 100px 0;
    word-wrap: break-word; /* Ensures long words will wrap */
  }




.form-left-title p{
    font-weight: 600;
    color: #ffffff;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

hr {
opacity: 100% !important;
}

.form-left-title hr{
    border: none;
    width: 5vh;
    height: 5px;
    background-color: #fffb00;
    border-radius: 10px;
    margin-bottom: 20px;
}

.form-left-title span{
    color:#ff0000;
}

.form-left span{
    display: flex;
    align-items: center;

    color: #ffffff;
    gap: 10px;
    border: none;
    cursor: pointer;
    position: relative;
    z-index: 6;    
}
.form-input {
  width: 70vh;
  height: 55px;
  border: none;
  outline: none;
  padding-left: 25px;
  font-weight: 500;
  color: #374955;
  border-radius: 50px;
  transition: border-color .3s ease-in-out, transform .3s ease-in-out;
}

.form-input:focus{
    border: 2.5px solid #7F3E6D !important;
    visibility: visible;
    opacity: 1;
    transform: scale(1.1);
    transition: transform .3s ease-in-out;
    
}


.form-input:focus::after {
    transform: scaleX(1);
}

.form-input:focus::after {
    transform: scaleX(0);
    transform-origin: right;
    transition: transform .35s;
}


/* Hide spinners for Chrome, Safari, Edge, and Opera */
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Hide spinners for Firefox */
input[type="number"] {
  -moz-appearance: textfield;
}


/* Back Button */
.back-to-history {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    padding-left: 0;
    width: 64px;
    cursor: pointer;
  }
  
  
  .back-to-history  div{
    display: flex;
    -moz-align-items: center;
    -ms-align-items: center;
    align-items: center;
    align-items: center;
    margin-bottom: 20px;
    cursor: pointer;
    padding: 10px 0 0px 0px!important;
  }
  
  
  
  .back-to-history span {
    color: #f3f3f3;
  }
  .back-to-history svg {
    fill: #f3f3f3;
  }
  
  .back-to-history svg {
    display: block;
    width: 15px;
    height: 15px;
    margin-right: 5px;
  }

/* Dropdown */
.dropdown {
    position: relative;
    display: inline-block;
    z-index: 1000;
  }

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    max-width: 100%; /* make sure the dropdown content doesn't exceed the parent's width */
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    width: 100.25vw;
    margin-top: 10px;
    padding: 10px; /* add some padding to make the content more readable */
    border-radius: 10px;
    max-height: 200px;
    overflow-y: auto;
    z-index: 200000; /* bring the dropdown content to the front */
  }
  
  .dropdown.form-input:focus + .dropdown-content {
    display: block;
  }
  
  .dropdown-content a {
    padding: 12px 16px;
    z-index: 1000;
    border-radius: 10px;
    text-decoration: none;
    display: block;
    cursor: pointer;
    color: #374955 !important;
  }
  
  .dropdown-content a:hover {
    background-color: #f1f1f1;
    z-index: 1000;
  }
  


.dropdown.form-input:focus + .dropdown-content {
  display: block;
  z-index: 1000;
}


.dropdown-content a {
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  color: #436074;
  z-index: 1000;
}

.dropdown-content a:hover {
  z-index: 1000;
  background-color: #f1f1f1;
}
  
  
  
.switch-toggle {
  width: 65px;
  height: 35px;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #007bff;
  border-radius: 50px;
  padding: 0 5px;
  cursor: pointer;
}
.form-input::placeholder{
    color: #436074;
}

.form-left textarea{
    height: 140px;
    padding-top: 15px;
    border-radius: 20px;
}

.button-left, .button-right{
  display: flex;
  flex: 1;
  flex-direction: row;
  align-items: start;
  gap: 20px;
}

.buttonID, .form-left-title .buttonID {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  gap: 2%; /* Menggunakan persentase sebagai pengganti px */
  z-index: -1;
  -webkit-box-pack: justify;
  -webkit-justify-content: space-between;
  justify-content: space-between;
  width: 80vw; /* Menggunakan vw sebagai pengganti vh */
  max-width: 600px; /* Menambahkan max-width untuk mencegah lebar yang terlalu besar */
}

.form-left button, .form-left-title button{
    display: flex;
    align-items: center;    
    justify-content: center; /* Add this property */
    text-align: center; /* Add this property */
    padding: 15px 30px;
    font-size: 16px;
    color: #ffffff;
    gap: 10px;
    border: none;
    border-radius: 50px;
    background: linear-gradient(270deg, #2c4091, #3A85C6);
    cursor: pointer;
    position: relative;
    z-index: 6;
}


#backButton {
  background: linear-gradient(270deg, #5B99C2, #1A4870);
}

.btn-reset {
  background:none !important;
  border-radius: 10px;
}

.progressBar{
    border: none;
    height: 5px;
    background-color: #4DDDA4;
}

.btn-submit svg, .form-left-title .btn-submit svg, .btn-reset svg, .btn-back svg{
    width: 1.25rem;
    height: 1.25rem;
    position: relative;
}


.btn-submit .btn, .form-left-title .btn-submit .btn, .btn-reset .btn, .btn-back .btn {
    position: absolute;
    top: 50%;
    left: 100%;
    margin-left: 30px;
    color: #fff;
    white-space: nowrap;
    padding: 7px 10px;
    transform: translateY(-50%);
    font-size: 0.95rem;
    border-radius: 5px;
    opacity: 0;
    visibility: hidden;
    transition: margin-left 0.3s ease;
  }


.btn-submit, .form-left-title .btn-submit, .btn-reset, .btn-back{
    overflow: hidden;
}

.btn-submit svg, .form-left-title .btn-submit svg, .btn-reset svg, .btn-back svg{
    z-index: 99;
    transition: transform .55s
}
.btn-submit p, .form-left-title .btn-submit p, .btn-reset p, .btn-back p{
    z-index: 99;
    transition: transform .55s;
    margin: 0;
}


.btn-submit::after, .form-left-title .btn-submit::after, .btn-reset::after, .btn-back::after{
    content: '';
    background: #ec00628a; 
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .35s;
}

.btn-submit:hover::after, .form-left-title .btn-submit:hover::after, .btn-reset:hover::after, .btn-back:hover::after{
    transform: scaleX(1);
}

.btn-submit:hover svg, .form-left-title .btn-submit:hover svg, .btn-back:hover svg{
    transform: scale(1.1);
}

.btn-submit:hover p, .form-left-title .btn-submit:hover p, .btn-back:hover p{
    transform: scale(1.1);
    color: #ffffff;   
}

/* Add this class to reset the styles */
.btn-submit.clicked, .form-left-title .btn-submit.clicked, .btn-reset.clicked {
  /* Reset the ::after pseudo-element */
  &::after {
    transform: scaleX(0);
  }
  /* Reset the SVG and text */
  svg, p {
    transform: scale(1);
  }
}

.form-left button img, .form-left-title button img {
    height: 15px;
    color: #ffffff
}
.img-wrapper {
  overflow: hidden;
}
.logo-header, .logo-output {
  position: static;
  pointer-events: none;
}
.form-right img{
  position: static;
    width: 30vh;
}
@media (max-width:1500px) {
    .footer p {
        font-size: 0.9rem;
        bottom: auto;
      }
      
}

@media (max-width:1420px) {
    .form-right img{
        width: 26vh;
    }
    #text-container {
      max-width: 75vh;
  }
   
}

@media (max-width:1020px) {
    .form-right img{
        width: 20vh;
    }
    
}

@media (max-width: 889px){
#text-container {
      max-width: 60vh;
  }

}

@media (max-width:985px) {
    .form-input{
        width:80vw;
    }
    .footer p {
        font-size: 0.7rem;
      }
    .form-left-title h2{
        font-size: 1.8rem;
    }
    #text-container {
      max-width: 55vh;
  }

    .form-left-title p{
        font-size: 0.7rem;
    }
    
    .form-right-load{
      display: flex;
    }
    .footer {
      bottom: 0;
      width: 100%;
    }
   .footer.container {
      flex-direction: column;
      align-items: center;
    }
   .footer img {
      width: 50px;
      height: auto;
      margin: 10px;
    }

    .form-container, .output-container {
      align-items: center;
      justify-content: center;
      padding: 10px;
    }
    
    .justify-content-center{
      padding: 15px;
     }
    #text-container {
      text-align: left;
    }
    .form-left, .form-right {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      gap: 10px;
      padding: 20px;
    }
    .form-container img, .output-container img {
        display: grid;
        align-items: center;
        justify-content: space-evenly;
    }

    .img-bg{
        display: none;
    }
    .container {
      padding: 10px;
    }
}

@media (max-width:490px) {
    
  .logo-header, .logo-output{
  display: none !important;
  }
  .output-container > .form-right {
    display: none;
  }
  .logo-footer {
  display: block;
  }
    .form-left-title h2 {
      font-size: 6vw;
  }
  #text-container {
    max-width: 45vh;
}
    .btn-submit svg, .form-left-title .btn-submit svg, .btn-reset svg{
      width: 0.6rem;
    height: 0.6rem;
    }
      .buttonID p {
        font-size: 0.8rem !important;
        }
    .form-input{
        width:85vw;
    }
    .footer {
      padding: 10px 0;
    }
   .footer p {
      font-size: 12px;
    }
   .footer img {
      width: 30px;
      height: auto;
      margin: 10px;
    }

    .form-container {
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 15px;
    }
    .justify-content-center{
      padding: 15px;
     }
    
    .output-container{
      align-items: center;
      justify-content: center;
      padding: 15px;
    }
    .form-left, .form-right {
      flex: 1;
      display: flex;
      flex-direction: column;      
      align-items: flex-start;
      justify-content: center;
      padding: 20px;
    }
    .form-left-title p{
        font-size: 3vw;
    }
    .form-left-title hr{
        width: 20vw;
    }

    .icon .img-bg{
        height: 100px;
    }
    .form-right img{
        width: 100px;
        display: flex;
        align-items: center;
        position: sticky;
        transform: translateY(35px);
        bottom:10px;
    }

    .container {
      padding: 5px;
    }
}

@media (max-width:490px) {
  #text-container {
    max-width: 35vh;
}

}
@media (max-width: 767px) {
    .btn-submit svg, .form-left-title .btn-submit svg, .btn-reset svg{
      width: 1rem;
    height: 1rem;
    }
    .buttonID p {
    font-size: 0.8rem;
    }
    
    .buttonID, .form-left-title .buttonID {
      flex-wrap: wrap;
    }
    .button-left, .button-right{
      justify-content: center;
    }
}
        </style>
<body >
<div class="main-container">
  <div class="container">

    <div class="row justify-content-center">
      <div id="error-message" style="display: none;"></div>
      <section id="form" class="form-container" >
        
        
              <!-- Form 1 -->
          <form id="Formulir1" name="submit-to-form" class="form-left">
          <h2 class="fs-1" id="text-container"></h2>
              <div class="form-left-title">
                <h2 class="fs-1">Masukkan data Kamu</h2>
                
                <p class="fs-16" id="title1">Silakan mengisi data dengan benar dan jangan sampai ada yang kosong</p>
                <p class="fs-16" id="alert1" style="display: none;">Loading......</p>
                <p class="fs-16" id="alerthapus1">Berhasil dihapus.</p>
                <hr id="progressBar">
              </div>
              
              <div class="mb-3">
                <div class="input-group mb-3">
                  <input type="text" id="nama" name="nama" placeholder="Nama kamu" class="form-input" required>
                </div>
                <div class="form-text" id="basic-addon4">Masukkan Nama lengkap kamu</div>
              </div>              
                
              <div class="mb-3">
                <div class="input-group mb-3">
                  <div class="dropdown">
                    <input type="text" id="jurusan" name="jurusan" placeholder="Jurusan" class="form-input" required>
                    <div class="dropdown-content">
                      <a href="#" data-value="S1 Sistem Informasi">S1 Sistem Informasi</a>
                      <a href="#" data-value="S1 Teknik Komputer">S1 Teknik Komputer</a>
                      <a href="#" data-value="DIII Sistem Informasi">DIII Sistem Informasi</a>
                      <a href="#" data-value="S1 Manajemen">S1 Manajemen</a>
                      <a href="#" data-value="S1 Akuntansi">S1 Akuntansi</a>
                      <a href="#" data-value="S1 Desain Komunikasi Visual">S1 Desain Komunikasi Visual</a>
                      <a href="#" data-value="S1 Desain Produk">S1 Desain Produk</a>
                      <a href="#" data-value="DIV Produksi Film dan Televisi">DIV Produksi Film dan Televisi</a>
                    </div>                   
                  </div>
                </div>
                <div class="form-text" id="basic-addon4">Masukkan Jurusan atau Prodi (Program Studi) kamu</div>
              </div>
                
                  
              
              
              <div class="mb-3">
                <div class="input-group mb-3">
                  <input id="nim" type="number" name="nim" placeholder="NIM kamu" class="nim-form form-input" required>
                </div>
                <div class="form-text" id="basic-addon4">Masukkan NIM kamu</div>
              </div>
              
              
              <div class="buttonID">
                <button class="btn btn-primary btn-submit" id="nextButton" type="button"><p>Lanjut</p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" fill="#FFFFFF"/></svg> </button>
                <button class="btn btn-secondary btn-reset" type="button" id="resetFormButton1"><p>Kosongkan Formulir</p></button>
              </div>
            </form>
        
        
            <!-- Form 2 -->
            <form id="Formulir2" name="submit-to-survey" class="form-left" style="display: none;">
              
              <div class="form-left-title">
                <h2 class="fs-2">Pilih sektemu di Sini</h2>
                <p class="fs-16" id="title2">Silakan mengisi Survey yang telah disediakan</p>
                <p class="fs-16" id="alert2" style="display: none;">Loading....</p>
                <p class="fs-16" id="alertback" style="display: none;">Kembali....</p>
                <p class="fs-16" id="alert3" style="display: none;">Data kamu berhasil dikirim</p>
                <p class="fs-16" id="alerthapus2">Berhasil dihapus.</p>
                <hr id="progressBar2">
              </div>
              
              <div class="khodam">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="khodam" placeholder="Apa khodam kamu??" class="khodam-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Khodam kamu apa nihhh??? Cek <a href="./khodam.html" target="_blank">disini</a>. Kosongi kalau tidak ada</div>
                </div>                
              </div>
              
              
              <div class="mb-3">
                <div class="input-group mb-3">
                  <div class="dropdown">
                    <input type="text" id="sekte" name="sekte" class="sekte-form form-input" placeholder="Pilih Sektemu">
                    <div class="dropdown-content">
                      <a href="#" data-value="Hololive">Hololive</a>
                      <a href="#" data-value="JKT48">JKT48</a>
                      <a href="#" data-value="Game">Game</a>
                      <a href="#" data-value="Anime">Anime</a>
                      <a href="#" data-value="Tokusatsu">Tokusatsu</a>
                      <a href="#" data-value="KPOP">KPOP</a>
                      <a href="#" data-value="Kritik">Kritik</a>
                      <a href="#" data-value="Sekte Lain">Sekte Lain</a>
                      <a href="#" data-value="Skip">Skip</a>
                    </div>
                  </div>
                </div>
                <div class="form-text" id="basic-addon4">Pilih sekte yang kamu mau, ada pilihan skip jika tidak ada</div>
              </div>
              
              <div class="hololive" style="display: none;">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="oshi_hololive" placeholder="Siapa Oshimu di Hololive?" class="oshi-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Wihh suka Vtuber juga?? Siapa oshimu nihhh?</div>
                </div>
              </div>
              
              
              <div class="jkt48" style="display: none;">              
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="oshi_jkt48" placeholder="Siapa Oshimu di JKT48?" class="oshi-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Wota banh?? Sapa Oshimu di JKT48??</div>
                </div>
              </div>
              
              
              <div class="KPOP" style="display: none;">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="group_kpop" placeholder="Siapa Group KPOP favoritmu?" class="group-kpop-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Spill dong Grup KPOP Favoritmu</div>
                </div>
                
                
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="bias_kpop" placeholder="Siapa bias favoritmu?" class="bias-kpop-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Jadi penasarun, siapa nihhh??</div>
                </div>
                
              </div>
              
              
              <div class="Tokusatsu" style="display: none;">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="tokusatsu" placeholder="Apa Tokusatsu favoritmu?" class="tokusatsu-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Team Tokusatsu mana nihhh???</div>
                </div>                
              </div>
              
              
              <div class="anime" style="display: none;">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="anime" placeholder="Apa judul anime yang kamu tonton?" class="game-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Sering nonton anime?? Siapa nihh anime yang sering ditonton?</div>
                </div>
              </div>
              
              
              <div class="game" style="display: none;">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="game" placeholder="Apa Game favoritmu?" class="game-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Game apa yang sering kamu mainkan atau favorit kamu</div>
                </div>
              </div>
              
              
              <div id="sekte_lain" style="display: none;" class="sekte_lain">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input type="text" name="sekte_lain" placeholder="Tuliskan disini" class="sektelain-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Sekte Lain?? Sekte apa nihhh</div>
                </div>                
              </div>
              
              
              <div class="kritik" style="display: none;" id="kritik">
                <div class="mb-3">
                  <div class="input-group">
                    <input type="text" name="kritik" placeholder="Apa hal yang suka kamu kritik?" class="kritik-form form-input" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Wahhh, ceritain dong</div>
                </div>
                
              </div>
              
              <div id="alasan" style="display: none;">
                <div class="mb-3">
                  <div class="input-group mb-3">
                    <input class="alasan-form form-input"  type="text" name="alasan" placeholder="Apa Alasannya?" required>
                  </div>
                  <div class="form-text" id="basic-addon4">Apa Alasannya?</div>
                </div>                
              </div>
                
                
              <div id="button2" class="buttonID">
              <div class="button-left">
              <button class="btn btn-primary btn-back" id="backButton" type="submit"><p>Kembali</p></button>
                <button class="btn btn-primary btn-submit" id="submitButton" type="submit"><p>Kirim</p></button>
              </div>
              <div class="button-right">
                <button class="btn btn-secondary btn-reset" type="button" id="resetFormButton2"><p>Kosongkan Formulir</p></button>
              </div>
                
              </div>
            </form>
            
              <div class="form-right">
                <div class="img-wrapper">
                  <img id="img" class="logo-header" src="/assets/LogoDaisekoiPutih.png" alt="png">
                  <div id="loadingIndicator" style="display: none;">
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                    </svg>
                </div>
                </div>
                  
                </div>
                
                  
                  
              </section>
            <section id="output" class="output-container" style="display: none;">
              <div class="form-left-title">
                <h2>Kamu akan diarahkan ke Grup Whatsapp Daisekoi, silakan join ya bruh</h2>
                <p>Halaman ini akan berubah dalam hitungan  <span id="msg"></span></p>
                <button id="redirect" class="btn-submit btn btn-primary"  type="submit"> <p>Klik disini</p><svg style="fill: #ffff;" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g data-name="Layer 2" id="Layer_2"><path d="M18,11a1,1,0,0,1-1,1,5,5,0,0,0-5,5,1,1,0,0,1-2,0,5,5,0,0,0-5-5,1,1,0,0,1,0-2,5,5,0,0,0,5-5,1,1,0,0,1,2,0,5,5,0,0,0,5,5A1,1,0,0,1,18,11Z"></path><path d="M19,24a1,1,0,0,1-1,1,2,2,0,0,0-2,2,1,1,0,0,1-2,0,2,2,0,0,0-2-2,1,1,0,0,1,0-2,2,2,0,0,0,2-2,1,1,0,0,1,2,0,2,2,0,0,0,2,2A1,1,0,0,1,19,24Z"></path><path d="M28,17a1,1,0,0,1-1,1,4,4,0,0,0-4,4,1,1,0,0,1-2,0,4,4,0,0,0-4-4,1,1,0,0,1,0-2,4,4,0,0,0,4-4,1,1,0,0,1,2,0,4,4,0,0,0,4,4A1,1,0,0,1,28,17Z"></path></g></svg></button>
            </div>
            
      
            <div class="form-right">
              <div class="img-wrapper">
                <img id="img2" class="logo-output" src="./assets/Logo - Daisekoi.png" alt="png">
                
              </div>
                
              </div>
            
            </section>
            
    </div>
    
 
      </div>


</div>


    
    
    <footer class="footer py-3"> 
    <div class="footer-container">
    <p>Website created by <a href="https://theputras.github.io/">THE PUTRAS</a> v1.0</p>
    <img src="/assets/Logo - Daisekoi.png" alt="png" class="logo-footer">
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/assets/js/indexPendaftaran.js"></script> 
    <!-- <script src="./k.js"></script> -->
    
    <script>
    const inputJurusan = document.getElementById('jurusan');
const inputSekte = document.getElementById('sekte');
const inputnama = document.getElementById('nama');
const inputnim = document.getElementById('nim');
const dropdownContent = document.querySelector('.dropdown-content');
const alasanForm = document.getElementById('alasan');
const resetFormButton1 = document.getElementById('resetFormButton1');
const resetFormButton2 = document.getElementById('resetFormButton2');
const loadingIndicator = document.getElementById('loadingIndicator');
const loadingIndicator2 = document.getElementById('loadingIndicator2');
const dropdownContentSekte = inputSekte.nextElementSibling; // get the dropdown content element
const sekteDropdown = inputSekte.nextElementSibling; // define sekteDropdown
const formRightImg = document.querySelector('.form-right img');
const formRight = document.querySelector('.form-right');
const output = document.querySelector('.output-container');
const form = document.querySelector('.form-container');
const backButton = document.getElementById('backButton');
const inputFields = document.querySelectorAll('.hololive, .jkt48, .KPOP, .Tokusatsu, .anime, .game, .kritik, .alasan-form');


//submit
const form1 = document.getElementById('Formulir1');
const form2 = document.getElementById('Formulir2');
const footer = document.querySelector('.footer');
const img = document.getElementById('img');
const img2 = document.getElementById('img2');
const nextButton = document.getElementById('nextButton');
const buttonDivs = document.getElementById('button2');
const alert1 = document.getElementById('alert1');
const alert2 = document.getElementById('alert2');
const alert3 = document.getElementById('alert3');
const alerthapus1 = document.getElementById('alerthapus1');
const alerthapus2 = document.getElementById('alerthapus2');
const alertback = document.getElementById('alertback');
const title1 = document.getElementById('title1');
const title2 = document.getElementById('title2');
const redirectButton = document.getElementById('redirectButton');
var url = "https://chat.whatsapp.com/IYek8OzV4jY6eaoSYK0mSa"; // Ganti dengan URL Grup Daisekoi tujuan Anda
var count = 5; // Waktu hitung mundur dalam detik
const sekteInput = document.querySelector('#sekte');
const selectedElement = Array.from(sekteDropdown.children).find(a => a.classList.contains('selected'));
let sekteValue = selectedElement ? selectedElement.dataset.value : null;
const urlForm = 'https://script.google.com/macros/s/AKfycby3reOfoU8gxgA2Jj3Q9pIcRcUKMkJW0RQTy62ztKISLnGmt3Ms3QRUay-Od13tmFh6/exec';


//form 2
const hololive = document.querySelector('.hololive');
const jkt48 = document.querySelector('.jkt48');
const game = document.querySelector('.game');
const kritik = document.querySelector('.kritik');
const anime = document.querySelector('.anime');
const kpop = document.querySelector('.kpop');
const tokusatsu = document.querySelector('.tokusatsu');
const sekteLain = document.querySelector('.sekte_lain');

// Show dropdown on input click or focus


inputJurusan.addEventListener('click', (e) => {
  dropdownContent.style.display = 'block';
});

inputJurusan.addEventListener('focus', (e) => {
  dropdownContent.style.display = 'block';
});

inputSekte.addEventListener('click', (e) => {
  dropdownContentSekte.style.display = 'block';
});

inputSekte.addEventListener('focus', (e) => {
  dropdownContentSekte.style.display = 'block';
});

// Prevent default behavior on mousedown in dropdown
dropdownContent.addEventListener('mousedown', (e) => {
  e.preventDefault();
});

dropdownContentSekte.addEventListener('mousedown', (e) => {
  e.preventDefault();
});


// Hide dropdown on blur if not clicking within it
inputJurusan.addEventListener('blur', (e) => {
  if (!dropdownContent.contains(document.activeElement)) {
    dropdownContent.style.display = 'none';
  }
});

inputSekte.addEventListener('blur', (e) => {
  if (!dropdownContentSekte.contains(document.activeElement)) {
    dropdownContentSekte.style.display = 'none';
  }
});



// Handle dropdown option click Jurusan
inputJurusan.addEventListener('input', (e) => {
  const inputValue = e.target.value.toLowerCase();
  const options = dropdownContent.querySelectorAll('a');

    // Filter existing options
    options.forEach((option) => {
      const optionValue = option.getAttribute('data-value').toLowerCase();
      if (optionValue === inputValue) {
        option.style.display = 'block';
      } else if (optionValue.includes(inputValue)) {
        option.style.display = 'block';
      } else {
        option.style.display = 'none';
      }
    });

  // Remove new options created based on user input
  const newOptions = dropdownContent.querySelectorAll('a[data-value][data-generated]');
  newOptions.forEach((option) => {
    option.remove();
  });

  // Check if the input value matches an existing data-value
  const isExistingValue = Array.from(options).some((option) => option.getAttribute('data-value').toLowerCase() === inputValue);

  // Create new options based on user input only if it's not an existing value and not a partial match
  if (inputValue && !isExistingValue && inputValue.trim().split(' ').every((word) => word.length > 1)) {
    const newOptions = [inputValue];
    newOptions.forEach((option) => {
      const newOption = document.createElement('a');
      newOption.textContent = option;
      newOption.setAttribute('data-value', option);
      newOption.setAttribute('data-generated', true); // Add this attribute to mark as generated
      dropdownContent.appendChild(newOption);
    });
  }

  // Show the dropdown content
  dropdownContent.style.display = 'block';
});


dropdownContent.addEventListener('click', (e) => {
  e.preventDefault(); // Add this line to prevent the default behavior
  if (e.target.tagName === 'A') {
    const value = e.target.getAttribute('data-value');
    inputJurusan.value = value;
    dropdownContent.style.display = 'none';
    inputJurusan.blur();
  }
});



// Handle dropdown option click Sekte
inputSekte.addEventListener('input', (e) => {
  const inputValue = e.target.value.toLowerCase();
  const options = dropdownContentSekte.querySelectorAll('a');

  options.forEach((option) => {
    const optionValue = option.textContent.toLowerCase();
    option.style.display = optionValue.includes(inputValue) ? 'block' : 'none';
  });

  // Check if no options are available
  const noOptionsAvailable = !Array.from(options).some((option) => option.style.display === 'block');
  
  // Show "Sekte Lain" option if no other options match
  const sekteLainOption = dropdownContentSekte.querySelector('a[data-value="Sekte Lain"]');
  if (noOptionsAvailable) {
    sekteLainOption.style.display = 'block';
  } 
  
    sekteLainOption.style.display = 'block';
});




  
  dropdownContentSekte.addEventListener('click', (e) => {
    e.preventDefault(); // Add this line to prevent the default behavior
    if (e.target.tagName === 'A') {
      const value = e.target.getAttribute('data-value');
      inputSekte.value = value;
      dropdownContentSekte.style.display = 'none';
      inputSekte.blur();
  
      // Hide all sections and remove required attribute
      [hololive, jkt48, game, anime, kritik, tokusatsu, kpop, sekteLain].forEach((section) => {
        section.style.display = 'none';
        section.querySelectorAll('input').forEach((input) => {
          input.removeAttribute('required');
          input.value = ''; // Reset input value
          localStorage.removeItem('form2Data');
        });
      });
  
      // Show the relevant section and set required attribute
      let selectedSection;
      switch (value) {
        case 'Hololive':
          selectedSection = hololive;
          break;
        case 'JKT48':
          selectedSection = jkt48;
          break;
        case 'Game':
          selectedSection = game;
          break;
        case 'Anime':
          selectedSection = anime;
          break;
        case 'Tokusatsu':
          selectedSection = tokusatsu;
          break;
        case 'KPOP':
          selectedSection = kpop;
          break;
        case 'Kritik':
          selectedSection = kritik;
          break;
        case 'Sekte Lain':
            selectedSection = sekteLain;
            break;
        default:
          selectedSection = null;
      }
  
      if (selectedSection) {
        selectedSection.style.display = 'flex';
        selectedSection.style.flexDirection = 'column';
        selectedSection.style.alignItems = 'start';
        selectedSection.style.gap = '20px';
        selectedSection.querySelectorAll('input').forEach((input) => {
          input.setAttribute('required', 'required');
        });
  
        // Append the alasan-form to the selected section
        selectedSection.appendChild(alasanForm);
        alasanForm.style.display = 'block';
        
        
        if (selectedSection == kritik) {
          // Clear reason form when critique section is selected
          selectedSection.appendChild(alasanForm);
          alasanForm.style.display = 'none';
        }
      }
    }
  });


//Reset form
    function resetForm(form) {
      form.reset();
      dropdownContentSekte.style.display = 'none';
      const selectedOptionSekte = dropdownContentSekte.querySelector('a[selected]');
      if (selectedOptionSekte) {
        selectedOptionSekte.removeAttribute('data-value');
        selectedOptionSekte.classList.remove('selected'); // remove the selected class
      }
      form.querySelectorAll('input, select, textarea').forEach(input => {
        input.value = '';
        input.removeAttribute('required');
      });
      [hololive, jkt48, game, anime, kritik, tokusatsu, kpop, sekteLain].forEach((section) => {
        section.style.display = 'none';
        section.querySelectorAll('input').forEach((input) => {
          input.removeAttribute('required');
        });
      });
    }

    resetFormButton1.addEventListener('click', () => {
      resetForm(form1);
      localStorage.removeItem('form1Data');
      title1.style.display = 'none';
      alerthapus1.style.display = 'block';
      setTimeout(() => {
        alerthapus1.style.display = 'none';
        title1.style.display = 'block';
      }, 2000); // show the alert for 2 seconds
    });

    resetFormButton2.addEventListener('click', () => {
      resetForm(form2);
      localStorage.removeItem('form2Data');
      title2.style.display = 'none'; 
      alerthapus2.style.display = 'block';
       
      setTimeout(() => {
        alerthapus2.style.display = 'none';
        title2.style.display = 'block';
      }, 2000); // show the alert for 2 seconds
    });



// ...

function handleError(error) {
  const errorElement = document.getElementById('error-message');
  errorElement.style.display = 'flex';
  errorElement.textContent = 'Website Error: ' + error.message + " Cek konsol";
  form.style.display = 'none';
}
window.onerror = function(error) {
  handleError(error);
};


let formDataSubmitted = false;

// ...





const textContainer = document.getElementById('text-container');
const texts = ['Selamat datang di UKM Daisekoi', 'Form Pendaftaran Anggota Daisekoi'];
let currentIndex = 0;
let currentText = '';
let currentCharIndex = 0;
let typingInterval;
let delayInterval;

function typeText() {
  if (currentCharIndex < currentText.length) {
    textContainer.textContent = currentText.substring(0, currentCharIndex + 1);
    currentCharIndex++;
    typingInterval = setTimeout(typeText, 100);
  } else {
    currentCharIndex = 0;
    delayInterval = setTimeout(function() {
      textContainer.textContent = ''; // clear text
      currentIndex = (currentIndex + 1) % texts.length; // loop to next text
      currentText = texts[currentIndex];
      typeText();
    }, 1000); // 1 second delay
  }
}

currentText = texts[currentIndex];
typeText();

document.querySelectorAll('.btn-submit, .form-left-title .btn-submit, .btn-reset').forEach(button => {
  button.addEventListener('click', () => {
    button.classList.toggle('clicked');
  });
});
//submit
// Form 1 (Formulir1)
// Initialize the forms
progressBar2.style.transition = 'width 3s ease-in-out';
progressBar2.style.width = "20%";
form1.classList.add('show');
footer.classList.add('show');
img.classList.add('show');
window.addEventListener('beforeunload', () => {
  localStorage.removeItem('form1Data');
  localStorage.removeItem('form2Data');
});

try {
nextButton.addEventListener('click', e => {
  e.preventDefault();
  // Get form 1 data
  const formData1 = new FormData(form1);
  const formData1Entries = Object.fromEntries(formData1.entries());
  // Check if form 1 data is empty
  if (Object.values(formData1Entries).some(value => value === '')) {
    alert('Ada yang kosong atau data salah, silakan di lengkapi');
    return;
  }
  else {      
    localStorage.setItem('form1Data', JSON.stringify(formData1Entries));
    
    alert1.style.display = 'block';
    title1.style.display = 'none';
      
    setTimeout(() => {
      form1.classList.remove('show');  
      img.classList.remove('show');
      form1.style.display = 'none';
      progressBar2.style.width = "50%";
      setTimeout(() => { 
        // Show loading indicator
        loadingIndicator.classList.add('loading-animation');
        loadingIndicator.style.display = 'flex';
        setTimeout(() => { 
          // Hide loading indicator after 2 seconds
          loadingIndicator.classList.remove('loading-animation');
          loadingIndicator.style.display = 'none';
          form1.style.display = 'none';
          form2.classList.add('show');
          img.classList.add('show');
        }, 2000); 
      }, 500); 
        
      setTimeout(() => {    
        alert1.style.display = 'none';
        title1.style.display = 'block';
        form2.style.display = 'flex';
        form2.style.alignItems = 'flex-start';
      }, 2500); 
    }, 2000);
  }
   
});
} catch (error) {
  handleError(error);
}




backButton.addEventListener('click', e => {
  e.preventDefault();  
  form1.style.display = 'none';
  progressBar2.style.width = "1%";
  alertback.style.display = "block";
  title2.style.display = 'none';
    setTimeout(() => {
      img.classList.remove('show');
      form2.classList.remove('show');
      setTimeout(() => { 
        // Show loading indicator
        loadingIndicator.classList.add('loading-animation');
        loadingIndicator.style.display = 'flex';
        setTimeout(() => { 
          // Hide loading indicator after 2 seconds
          alertback.style.display = "none";
          title2.style.display = 'block';
          loadingIndicator.classList.remove('loading-animation');
          loadingIndicator.style.display = 'none';
          form2.style.display = 'none';
          form1.classList.add('show');
          img.classList.add('show');
        }, 2000); 
      }, 500); 
        
      setTimeout(() => {    
        alert1.style.display = 'none';
        title1.style.display = 'block';
        form1.style.display = 'flex';
      }, 2500); 
    }, 2000);
  
});

// Form 2 (Formulir2)
const submitButton = document.getElementById('submitButton');

// Get all form 2 input elements
const form2Inputs = document.querySelectorAll('#Formulir2 input');

// Function to save form data to local storage
function saveFormData() {
  // Get form data
  const formData2 = new FormData(form2);

  // Convert FormData object to an object
  const formDataObj = Object.fromEntries(formData2.entries());

  // Save form data to local storage
  localStorage.setItem('form2Data', JSON.stringify(formDataObj));
}


submitButton.addEventListener('click', e => {
  e.preventDefault();
  // Get form 1 data from cache
  const formData1 = JSON.parse(localStorage.getItem('form1Data'));
  // Get form 2 data from cache

  // Save form data to local storage
  saveFormData();

  // Get form 2 data from cache
  let formData2 = localStorage.getItem('form2Data');
  if (formData2) {
    formData2 = JSON.parse(formData2);
  } else {
    formData2 = {}; // Initialize an empty object if cache is empty
  }
  const sekteValue = formData2.sekte;
   // ...

  

// ...  
form2Inputs.forEach(input => {
  input.disabled = false;
});
  // Check data form 2
  if (sekteValue === 'Hololive' && (!formData2 || formData2.oshi_hololive === '' || formData2.alasan === '')) {
    alert('Isi oshi hololive kamu, jangan sampai kosong');
    return;
  } else if (sekteValue === 'JKT48' && (!formData2 || formData2.oshi_jkt48 === '' || formData2.alasan === '')) {
    alert('Isi oshi jkt48 kamu, jangan sampai kosong');
    return;
  } else if (sekteValue === 'KPOP' && (!formData2 || formData2.group_kpop === '' || formData2.bias_kpop === '' || formData2.alasan === '')) {
    alert('Isi group kpop dan bias kpop kamu, jangan sampai kosong');
    return;
  } else if (sekteValue === 'Tokusatsu' && (!formData2 || formData2.tokusatsu === '' || formData2.alasan === '')) {
    alert('Isi tokusatsu kamu, jangan sampai kosong');
    return;
  } else if (sekteValue === 'Anime' && (!formData2 || formData2.anime === '' || formData2.alasan === '')) {
    alert('Isi anime kamu, jangan sampai kosong');
    return;
  } else if (sekteValue === 'Game' && (!formData2 || formData2.game === '' || formData2.alasan === '')) {
    alert('Isi game kamu, jangan sampai kosong');
    return;
  } else if (sekteValue === 'Kritik' && (!formData2 || formData2.kritik === '')) {
    alert('Isi kritik kamu, jangan sampai kosong');
    return;
  } else if (sekteValue === 'Sekte Lain' && (!formData2 || formData2.sekte_lain === '' || formData2.alasan === '')) {
    alert('Isi sekte lain kamu, jangan sampai kosong');
    return;
  } else if (!formData2 || formData2.sekte === '') {
    alert('Isi semua field di form ini');
    return;
  }
  

  
  // Combine form 1 and filtered form 2 data
  const combinedData = new FormData();
  for (const key in formData1) {
    if (formData1.hasOwnProperty(key)) {
      combinedData.append(key, formData1[key]);
    }
  }
  for (const [key, value] of Object.entries(formData2)) {
    if (formData2.hasOwnProperty(key)) {
      combinedData.append(key, value);
    }
  }
// Make input fields of Form 2 readonly
form2Inputs.forEach(input => {
  input.disabled = true;
});
  
  // Add additional fields to combinedData
  const inputs = document.querySelectorAll('input[type="text"]');
  inputs.forEach(input => {
    combinedData.append(input.name, input.value);
  });
  progressBar2.style.width = "0%";  
  // Simulasi loading (misalnya, fetch data dari server)
  setTimeout(() => {

    progressBar2.style.transition = 'width 3s ease-in-out';
   progressBar2.style.width = "100%";   
    alert2.style.display = 'block';
    title2.style.display = 'none';  
    buttonDivs.style.display = 'none';
    // Show loading indicator
    img.classList.remove('show');
    loadingIndicator.classList.add('loading-animation');
    loadingIndicator.style.display = 'flex';
    fetch(urlForm, { method: 'POST', body: combinedData })
  .then(response => response.json())
  .then(data => {
    console.log('Response from URL Form:', data);
    formDataSubmitted = true;
                  // Clear cache data
                  localStorage.removeItem('form1Data');
                  localStorage.removeItem('form2Data');
                  //Success Warning
                  alert2.style.display = 'none';
                  alert3.style.display = 'block';
                    // Hide form 1 and show form 2
                    setTimeout(() => {
                      // Hide form 1 and show form 2
                      form.style.display = 'none';
                      img2.classList.add('show');
                      output.classList.add('show');
                      output.style.display = 'flex';
                      //countdown output
                      function countDown() {
                        if (count > 0) {
                          count--;
                          var waktu = count + 1;
                          document.getElementById('msg').innerHTML =  waktu;
                          setTimeout(countDown, 1000); // Memanggil fungsi ini setiap 1 detik
                        } else {
                          window.location.replace(url); // Mengarahkan pengguna setelah hitung mundur selesai
                        }
                      }
                      // Memulai hitung mundur saat halaman dimuat
                      countDown();
                    }, 1000); // Setelah 1 detik, tampilkan output
        
  
  })
  .catch(error => console.error('Error URL 1!', error.message));
    setTimeout(() => { 
      progressBar2.style.transition = 'width 3s ease-in-out';
    progressBar2.style.display ='none';
    // Submit combined data to both URLs
  
    }, 3000); // Setelah 3 detik, sembunyikan progress bar
  }, 500); // Setelah 1 detik, perbarui progress bar ke 100%

  
});

window.onload = function() {
  const redirectButton = document.getElementById('redirect');
  redirectButton.addEventListener('click', () => {
    window.location.replace(url);
  });
}


// When the user tries to close the tab, check if formDataSubmitted is false
window.onbeforeunload = function(e) {
  if (!formDataSubmitted) {
    var message = "Anda yakin ingin meninggalkan halaman ini? Data belum dikirim!";
    return message;
  }
};
    </script>
</body>


</html>


<?php
include "koneksi.php";


// Fungsi ambil semua data item
function getAllItems() {

    global $conn;
    // Ambil juga harga_beli dari database
    $result = $conn->query("SELECT *, harga_beli FROM item ORDER BY kode_item ASC");
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $items]);
}


// Fungsi insert item
function insertItem() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Harus menggunakan metode POST."
        ]);
        return;
    }

    $nama   = $_POST['nama']   ?? '';
    $satuan = $_POST['satuan'] ?? '';
    $harga = floatval($_POST['harga'] ?? 0); // Ini adalah harga_jual
    $harga_beli = floatval($_POST['harga_beli'] ?? 0); // Ambil harga_beli
    $jumlah_item = intval($_POST['jumlah_item'] ?? 0);


    if ($nama === '' || $satuan === '' || $harga === '' || $harga_beli === '') { // Tambahkan validasi harga_beli
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Data POST tidak lengkap (insert). Pastikan harga beli dan harga jual terisi."
        ]);
        return;
    }

    // Auto-generate kode_item kalau kosong
    $kode_item = $_POST['kode_item'] ?? '';
    if ($kode_item === '') {
        do {
            $kode_item = 'item' . random_int(100000, 999999);
            $cek = $conn->prepare("SELECT kode_item FROM item WHERE kode_item = ?");
            $cek->bind_param("s", $kode_item);
            $cek->execute();
            $cek->store_result();
        } while ($cek->num_rows > 0);
    }

    // Cek duplikat (lagi aja biar aman kalau ada manual kirim kode)
    $cek = $conn->prepare("SELECT kode_item FROM item WHERE kode_item = ?");
    $cek->bind_param("s", $kode_item);
    $cek->execute();
    $cek->store_result();
    if ($cek->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ kode_item $kode_item sudah terdaftar."
        ]);
        return;
    }

    // Sesuaikan query INSERT dan bind_param untuk harga_beli
    // PERBAIKAN: Ubah "ssddii" menjadi "sssddi"
    $stmt = $conn->prepare("INSERT INTO item (kode_item, nama, satuan, harga, harga_beli, jumlah_item) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddi", $kode_item, $nama, $satuan, $harga, $harga_beli, $jumlah_item);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "✅ Item berhasil disimpan dengan kode $kode_item."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "❌ Gagal menyimpan item: " . $stmt->error
        ]);
    }
}


function deleteItem() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Harus menggunakan metode POST."
        ]);
        return;
    }

    if (empty($_POST['kode_item'])) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ kode_item item tidak boleh kosong."
        ]);
        return;
    }

    $kode_item = $_POST['kode_item'];

    $conn->begin_transaction(); // Mulai transaksi

    try {
        // 1. Hapus record dari detailpembelian yang terkait dengan item ini
        $stmt_del_detailpembelian = $conn->prepare("DELETE FROM detailpembelian WHERE kode_item = ?");
        $stmt_del_detailpembelian->bind_param("s", $kode_item);
        $stmt_del_detailpembelian->execute();

        // 2. Hapus record dari detailpenjualan yang terkait dengan item ini
        $stmt_del_detailpenjualan = $conn->prepare("DELETE FROM detailpenjualan WHERE kode_item = ?");
        $stmt_del_detailpenjualan->bind_param("s", $kode_item);
        $stmt_del_detailpenjualan->execute();

        // 3. Sekarang, hapus item dari tabel item
        $stmt = $conn->prepare("DELETE FROM item WHERE kode_item = ?");
        $stmt->bind_param("s", $kode_item);
        
        if ($stmt->execute()) {
            $conn->commit(); // Commit transaksi jika semua berhasil
            echo json_encode([
                "status" => "success",
                "message" => "🗑️ Item berhasil dihapus beserta detail terkait."
            ]);
        } else {
            throw new Exception("Gagal menghapus item.");
        }
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaksi jika ada kesalahan
        echo json_encode([
            "status" => "error",
            "message" => "❌ Gagal menghapus item: " . $e->getMessage()
        ]);
    }
}


function updateItem() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "⚠️ Harus POST"]);
        return;
    }

    $kode_item = $_POST['kode_item'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $satuan = $_POST['satuan'] ?? '';
    $harga_jual = floatval($_POST['harga'] ?? 0); // Ambil harga_jual dari name="harga"
    $harga_beli = floatval($_POST['harga_beli'] ?? 0); // Ambil harga_beli
    $jumlah_item = intval($_POST['jumlah_item'] ?? 0);

    if (!$kode_item || !$nama || !$satuan || $harga_jual === '' || $harga_beli === '') { // Tambahkan validasi harga_beli
        echo json_encode(["status" => "error", "message" => "⚠️ Data tidak lengkap. Pastikan semua field terisi."]);
        return;
    }

    // Sesuaikan query UPDATE dan bind_param untuk harga_beli
    $stmt = $conn->prepare("UPDATE item SET nama = ?, satuan = ?, harga = ?, harga_beli = ?, jumlah_item = ? WHERE kode_item = ?");
    $stmt->bind_param("ssddis", $nama, $satuan, $harga_jual, $harga_beli, $jumlah_item, $kode_item);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Item berhasil diupdate."]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Gagal update item: " . $stmt->error]);
    }
}

function deleteMultipleItems() {
    global $conn;

    $kodeList = $_POST['kode_list'] ?? [];

    if (!is_array($kodeList) || count($kodeList) === 0) {
        echo json_encode(["status" => "error", "message" => "⚠️ Tidak ada data terpilih."]);
        return;
    }

    $conn->begin_transaction(); // Mulai transaksi

    try {
        foreach ($kodeList as $kode_item) {
            // Hapus record dari detailpembelian yang terkait dengan item ini
            $stmt_del_detailpembelian = $conn->prepare("DELETE FROM detailpembelian WHERE kode_item = ?");
            $stmt_del_detailpembelian->bind_param("s", $kode_item);
            $stmt_del_detailpembelian->execute();

            // Hapus record dari detailpenjualan yang terkait dengan item ini
            $stmt_del_detailpenjualan = $conn->prepare("DELETE FROM detailpenjualan WHERE kode_item = ?");
            $stmt_del_detailpenjualan->bind_param("s", $kode_item);
            $stmt_del_detailpenjualan->execute();

            // Hapus item dari tabel item
            $stmt_del_item = $conn->prepare("DELETE FROM item WHERE kode_item = ?");
            $stmt_del_item->bind_param("s", $kode_item);
            $stmt_del_item->execute();
        }

        $conn->commit(); // Commit transaksi jika semua berhasil
        echo json_encode(["status" => "success", "message" => "✅ Berhasil menghapus beberapa item beserta detail terkait."]);
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaksi jika ada kesalahan
        echo json_encode(["status" => "error", "message" => "❌ Gagal menghapus item: " . $e->getMessage()]);
    }
}





// Penjualan
function insertPenjualan() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Harus menggunakan metode POST."
        ]);
        return;
    }

    $konsumen = $_POST['konsumen'] ?? '';
    $items = $_POST['items'] ?? []; // Array of item

    if ($konsumen === '' || !is_array($items) || count($items) === 0) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Data transaksi tidak lengkap."
        ]);
        return;
    }

    $conn->begin_transaction();

    try {
        // Hitung total dan qty
        $total_penjualan = 0;
        $totalqty = 0;

        foreach ($items as $item) {
            $qty = intval($item['qty']);
            $harga = floatval($item['harga']); // Ini harga jual
            $subtotal = $qty * $harga;

            $total_penjualan += $subtotal;
            $totalqty += $qty;
        }

        // Insert ke master
        $stmt = $conn->prepare("INSERT INTO masterpenjualan (konsumen, total_penjualan, totalqty) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $konsumen, $total_penjualan, $totalqty);
        $stmt->execute();
        $kodetr = $conn->insert_id;

        // Insert ke detail dan update stok item
        $stmtDetail = $conn->prepare("INSERT INTO detailpenjualan (kodetr, kode_item, jumlah, subtotal) VALUES (?, ?, ?, ?)");
        $stmtUpdateStok = $conn->prepare("UPDATE item SET jumlah_item = jumlah_item - ? WHERE kode_item = ?"); // Query untuk mengurangi stok

        foreach ($items as $item) {
            $kode_item = $item['kode_item'];
            $harga = floatval($item['harga']); // Ini harga jual
            $qty = intval($item['qty']);
            $subtotal = $harga * $qty;

            // Cek stok sebelum update
            $check_stok_stmt = $conn->prepare("SELECT jumlah_item FROM item WHERE kode_item = ?");
            $check_stok_stmt->bind_param("s", $kode_item);
            $check_stok_stmt->execute();
            $check_stok_result = $check_stok_stmt->get_result();
            $current_stock = $check_stok_result->fetch_assoc()['jumlah_item'] ?? 0;

            if ($current_stock < $qty) {
                throw new Exception("Stok untuk item $kode_item tidak cukup. Stok tersedia: $current_stock, Diminta: $qty");
            }

            // Insert detail penjualan
            $stmtDetail->bind_param("isid", $kodetr, $kode_item, $qty, $subtotal);
            $stmtDetail->execute();

            // Update stok item
            $stmtUpdateStok->bind_param("is", $qty, $kode_item);
            $stmtUpdateStok->execute();
        }

        $conn->commit();
        echo json_encode([
            "status" => "success",
            "message" => "✅ Transaksi berhasil disimpan dengan kode $kodetr dan stok diperbarui."
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            "status" => "error",
            "message" => "❌ Gagal simpan transaksi: " . $e->getMessage()
        ]);
    }
}

function getPenjualan() {
    global $conn;
    $sql = "
        SELECT 
            mp.kodetr,
            mp.tanggal,
            mp.konsumen,
            mp.total_penjualan,
            mp.totalqty
        FROM masterpenjualan mp
        ORDER BY mp.tanggal DESC
    ";
    $result = $conn->query($sql);
    $penjualan = [];
    while ($row = $result->fetch_assoc()) {
        $penjualan[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $penjualan]);
}


// Endpoint baru untuk Select2 agar bisa mencari dan mengembalikan data dalam format yang diharapkan Select2
function getItemsForSelect2() {
    global $conn;
    $searchTerm = $_GET['q'] ?? '';
    $page = $_GET['page'] ?? 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    // Hitung total_count untuk pagination
    $total_count_query = "SELECT COUNT(*) FROM item WHERE nama LIKE ? OR kode_item LIKE ?";
    $stmt_count = $conn->prepare($total_count_query);
    $search_param = "%" . $searchTerm . "%";
    $stmt_count->bind_param("ss", $search_param, $search_param);
    $stmt_count->execute();
    $stmt_count->bind_result($total_count);
    $stmt_count->fetch();
    $stmt_count->close();

    // Query untuk mengambil data item yang difilter dan dipaginasi
    // Perhatikan penambahan kolom 'satuan'
    $sql = "SELECT kode_item, nama, jumlah_item, harga, satuan FROM item WHERE nama LIKE ? OR kode_item LIKE ? ORDER BY nama ASC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $search_param, $search_param, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        // Format data sesuai yang diharapkan Select2
        $data[] = [
            'id' => $row['kode_item'],
            'text' => "{$row['nama']} (Stok: {$row['jumlah_item']}, Harga: Rp. {$row['harga']}) - {$row['kode_item']}",
            'nama' => $row['nama'], 
            'satuan' => $row['satuan'], // Pastikan kolom satuan diambil di query
            'harga' => $row['harga'] 
        ];
    }
    
    echo json_encode([
        "results" => $data,
        "pagination" => [
            "more" => ($offset + count($data)) < $total_count
        ],
        "total_count" => $total_count, // Tambahkan total_count untuk debug/informasi
        "data" => $data // Tambahkan ini juga, meskipun Select2 hanya pakai "results"
    ]);
}


// Fungsi ini sekarang akan mengembalikan array data lengkap, bukan HTML options string
function getItemOptions() {
    global $conn;
    $result = $conn->query("SELECT kode_item, nama, jumlah_item, harga, satuan FROM item ORDER BY nama ASC"); // Ambil semua kolom yang relevan
    $full_data = []; // Untuk menyimpan data lengkap setiap item
    while ($row = $result->fetch_assoc()) {
        $full_data[] = [
            'kode_item' => $row['kode_item'],
            'nama' => $row['nama'],
            'jumlah_item' => $row['jumlah_item'],
            'harga' => $row['harga'],
            'satuan' => $row['satuan'] // Tambahkan satuan di sini
        ];
    }
    // Kirimkan full_data sebagai JSON array
    echo json_encode(["status" => "success", "full_data" => $full_data]);
}


function getItemByKode() {
    global $conn;

    if (!isset($_GET['kode_item'])) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Parameter kode_item tidak ditemukan."
        ]);
        return;
    }

    $kode = $_GET['kode_item'];

    // Ambil juga harga_beli
    $stmt = $conn->prepare("SELECT *, harga_beli FROM item WHERE kode_item = ?");
    $stmt->bind_param("s", $kode);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item) {
        echo json_encode([
            "status" => "success",
            "data" => $item
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "❌ Item tidak ditemukan."
        ]);
    }
}


function detailPenjualan() {
    global $conn;

    if (!isset($_GET['kodetr'])) {
        echo json_encode([
            "status" => "error",
            "message" => "⚠️ Parameter kodetr tidak ditemukan."
        ]);
        return;
    }

    $kodetr = $_GET['kodetr'];

    $sql = "
        SELECT 
            dp.kode_item,
            i.nama,
            i.satuan,
            dp.jumlah AS qty,
            dp.subtotal,
            (dp.subtotal / dp.jumlah) AS harga -- Ini adalah harga jual
        FROM detailpenjualan dp
        JOIN item i ON dp.kode_item = i.kode_item
        WHERE dp.kodetr = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $kodetr);
    $stmt->execute();
    $result = $stmt->get_result();

    $detail = [];
    while ($row = $result->fetch_assoc()) {
        $detail[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "data" => $detail
    ]);
}

// Pembelian
function insertPembelian() {
    global $conn;

    // Periksa apakah request method adalah POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode(["status" => "error", "message" => "Metode request harus POST."]);
        return;
    }

    // Ambil data dari POST request
    $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? date('Y-m-d'); // Tanggal pembelian
    $kode_supplier = $_POST['kode_supplier'] ?? '';
    $items_pembelian = $_POST['items_pembelian'] ?? []; // Ini adalah array item yang dibeli

    // Validasi input utama
    if (empty($kode_supplier) || !is_array($items_pembelian) || count($items_pembelian) === 0) {
        echo json_encode(["status" => "error", "message" => "Data pembelian tidak lengkap atau format tidak sesuai."]);
        return;
    }

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        $total_biaya = 0;
        // Hitung total biaya dari semua item yang dibeli
        foreach ($items_pembelian as $item) {
            $jumlah = intval($item['jumlah'] ?? 0);
            $harga_beli = floatval($item['harga_beli'] ?? 0);
            $total_biaya += ($jumlah * $harga_beli);
        }

        // Insert ke tabel master `pembelian`
        // Perhatikan: status_pembelian default 'pending'
        $stmt_master = $conn->prepare("INSERT INTO pembelian (kode_supplier, tanggal_pembelian, total_biaya, status_pembelian) VALUES (?, ?, ?, 'pending')");
        $stmt_master->bind_param("ssd", $kode_supplier, $tanggal_pembelian, $total_biaya);
        $stmt_master->execute();
        $id_pembelian = $conn->insert_id; // Ambil ID pembelian yang baru saja dibuat

        // Insert ke tabel `detailpembelian` dan update stok `item`
        $stmt_detail = $conn->prepare("INSERT INTO detailpembelian (id_pembelian, kode_item, jumlah, harga_beli, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmt_update_stok = $conn->prepare("UPDATE item SET jumlah_item = jumlah_item + ? WHERE kode_item = ?"); // Tambah stok

        foreach ($items_pembelian as $item) {
            $kode_item = $item['kode_item'] ?? '';
            $jumlah = intval($item['jumlah'] ?? 0);
            $harga_beli = floatval($item['harga_beli'] ?? 0);
            $subtotal_item = $jumlah * $harga_beli;

            // Validasi per item
            if (empty($kode_item) || $jumlah <= 0 || $harga_beli <= 0) {
                throw new Exception("Data item dalam pembelian tidak lengkap atau tidak valid.");
            }

            // Insert detail pembelian
            $stmt_detail->bind_param("isidd", $id_pembelian, $kode_item, $jumlah, $harga_beli, $subtotal_item);
            $stmt_detail->execute();

            // Update stok item
            $stmt_update_stok->bind_param("is", $jumlah, $kode_item);
            $stmt_update_stok->execute();
        }

        $conn->commit();
        echo json_encode(["status" => "success", "message" => "✅ Pembelian berhasil ditambahkan dengan ID: " . $id_pembelian]);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["status" => "error", "message" => "❌ Gagal menambahkan pembelian: " . $e->getMessage()]);
    }
}

function getPembelian() {
    global $conn;

    // Query untuk mengambil pembelian
    $sql = "SELECT p.*, s.nama_supplier FROM pembelian p JOIN supplier s ON p.kode_supplier = s.kode_supplier ORDER BY p.tanggal_pembelian DESC";
    $result = $conn->query($sql);

    $pembelian = []; // Inisialisasi array kosong
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pembelian[] = $row;
        }
    }
    // PERBAIKAN: Selalu kembalikan status success dengan data (bisa kosong)
    echo json_encode(["status" => "success", "data" => $pembelian]);
}


function updatePembelian() {
    global $conn;

    $id_pembelian = $_POST['id_pembelian'] ?? 0;
    $kode_supplier = $_POST['kode_supplier'] ?? '';
    $total_biaya = $_POST['total_biaya'] ?? 0;
    $status_pembelian = $_POST['status_pembelian'] ?? 'pending';

    if ($id_pembelian <= 0 || empty($kode_supplier) || $total_biaya <= 0) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap atau invalid."]);
        return;
    }

    // Update pembelian
    $stmt = $conn->prepare("UPDATE pembelian SET nama_supplier = ?, alamat = ?, kontak = ?, email = ? WHERE kode_supplier = ?");
    $stmt->bind_param("sssss", $nama_supplier, $alamat, $kontak, $email, $kode_supplier);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Supplier berhasil diupdate."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal mengupdate supplier."]);
    }
}


function deletePembelian() {
    global $conn;

    $id_pembelian = $_POST['id_pembelian'] ?? 0;

    if ($id_pembelian <= 0) {
        echo json_encode(["status" => "error", "message" => "ID pembelian tidak valid."]);
        return;
    }

    $conn->begin_transaction(); // Mulai transaksi

    try {
        // Ambil detail pembelian untuk mengembalikan stok
        $detail_stmt = $conn->prepare("SELECT kode_item, jumlah FROM detailpembelian WHERE id_pembelian = ?");
        $detail_stmt->bind_param("i", $id_pembelian);
        $detail_stmt->execute();
        $detail_result = $detail_stmt->get_result();

        $update_stok_stmt = $conn->prepare("UPDATE item SET jumlah_item = jumlah_item - ? WHERE kode_item = ?");

        while ($row = $detail_result->fetch_assoc()) {
            $kode_item = $row['kode_item'];
            $jumlah = $row['jumlah'];
            $update_stok_stmt->bind_param("is", $jumlah, $kode_item);
            $update_stok_stmt->execute();
        }

        // Hapus detail pembelian terkait
        $delete_detail_stmt = $conn->prepare("DELETE FROM detailpembelian WHERE id_pembelian = ?");
        $delete_detail_stmt->bind_param("i", $id_pembelian);
        $delete_detail_stmt->execute();

        // Hapus pembayaran terkait (jika ada)
        $delete_pembayaran_stmt = $conn->prepare("DELETE FROM pembayaran WHERE id_pembelian = ?");
        $delete_pembayaran_stmt->bind_param("i", $id_pembelian);
        $delete_pembayaran_stmt->execute();

        // Hapus pembelian
        $stmt = $conn->prepare("DELETE FROM pembelian WHERE id_pembelian = ?");
        $stmt->bind_param("i", $id_pembelian);
        if ($stmt->execute()) {
            $conn->commit(); // Commit transaksi jika semua berhasil
            echo json_encode(["status" => "success", "message" => "Pembelian berhasil dihapus dan stok dikembalikan."]);
        } else {
            throw new Exception("Terjadi kesalahan saat menghapus pembelian.");
        }
    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaksi jika ada kesalahan
        echo json_encode(["status" => "error", "message" => "❌ Gagal menghapus pembelian: " . $e->getMessage()]);
    }
}


function getDetailPembelian() {
    global