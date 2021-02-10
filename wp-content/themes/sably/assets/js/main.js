$(document).ready(function () {
  //---------------------------
  //Systeme d'onglet de la home
  //---------------------------

  $(".button-home").on("click", function () {
    $("section#about").fadeOut("");
    $("section#contact").fadeOut("");
    $("section#login").fadeOut("");
    $("section#signin").fadeOut("");
    setTimeout(function () {
      $("section#home").fadeIn("");
    }, 500);
  });

  $(".button-about").on("click", function () {
    $("section#home").fadeOut("");
    $("section#contact").fadeOut("");
    $("section#login").fadeOut("");
    $("section#signin").fadeOut("");
    setTimeout(function () {
      $("section#about").fadeIn("");
    }, 500);
  });

  $(".button-contact").on("click", function () {
    $("section#about").fadeOut("");
    $("section#home").fadeOut("");
    $("section#login").fadeOut("");
    $("section#signin").fadeOut("");
    setTimeout(function () {
      $("section#contact").fadeIn("");
    }, 500);
  });

  $(".button-login").on("click", function () {
    $("section#about").fadeOut("");
    $("section#contact").fadeOut("");
    $("section#home").fadeOut("");
    $("section#signin").fadeOut("");
    setTimeout(function () {
      $("section#login").fadeIn("");
    }, 500);
  });

  $(".button-signin").on("click", function () {
    $("section#about").fadeOut("");
    $("section#contact").fadeOut("");
    $("section#home").fadeOut("");
    $("section#login").fadeOut("");
    setTimeout(function () {
      $("section#signin").fadeIn("");
    }, 500);
  });
});
