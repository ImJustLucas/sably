//----------------------------
//DEBUT JQUERY
//----------------------------
$(document).ready(function () {
  //---------------------------
  //Systeme d'onglet de la home
  //---------------------------

  $(".button-home").on("click", function () {
    $("section#about").fadeOut("");
    $("section#contact").fadeOut("");
    setTimeout(function () {
      $("section#home").fadeIn("");
    }, 500);
  });

  $(".button-about").on("click", function () {
    $("section#home").fadeOut("");
    $("section#contact").fadeOut("");
    setTimeout(function () {
      $("section#about").fadeIn("");
    }, 500);
  });

  $(".button-contact").on("click", function () {
    $("section#about").fadeOut("");
    $("section#home").fadeOut("");
    setTimeout(function () {
      $("section#contact").fadeIn("");
    }, 500);
  });

  $(".button-login").on("click", function () {
    $("section#signin").fadeOut("");
    setTimeout(function () {
      $("section#login").fadeIn("");
    }, 500);
  });

  $(".button-signin").on("click", function () {
    $("section#login").fadeOut("");
    setTimeout(function () {
      $("section#signin").fadeIn("");
    }, 500);
  });

  //--------------------
  //Popup plugin
  //--------------------

  $(".logo-play a").magnificPopup({
    type: "iframe",
    src: "https://www.youtube.com/watch?v=oUhWsKMcoKY",
    // other options
  });

  //------------------
  //FIN JQUERY
  //------------------
});

//--------------------
//Animation home page
//--------------------

class TypeWriter {
  constructor(txtElement, words, wait = 4000) {
    this.txtElement = txtElement;
    this.words = words;
    this.txt = "";
    this.wordIndex = 0;
    this.wait = parseInt(wait, 10);
    this.type();
    this.isDeleting = false;
  }

  type() {
    // Current index of word
    const current = this.wordIndex % this.words.length;
    // Get full text of current word
    const fullTxt = this.words[current];

    // Check if deleting
    if (this.isDeleting) {
      // Remove char
      this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
      // Add char
      this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    // Insert txt into element
    this.txtElement.innerHTML = `<span class="txt">${this.txt}</span>`;

    // Initial Type Speed
    let typeSpeed = 100;

    if (this.isDeleting) {
      typeSpeed /= 2;
    }

    // If word is complete
    if (!this.isDeleting && this.txt === fullTxt) {
      // Make pause at end
      typeSpeed = this.wait;
      // Set delete to true
      this.isDeleting = true;
    } else if (this.isDeleting && this.txt === "") {
      this.isDeleting = false;
      // Move to next word
      this.wordIndex++;
      // Pause before start typing
      typeSpeed = 500;
    }

    setTimeout(() => this.type(), typeSpeed);
  }
}

// Init On DOM Load
document.addEventListener("DOMContentLoaded", init);

// Init App
function init() {
  const txtElement = document.querySelector(".txt-type");
  const words = JSON.parse(txtElement.getAttribute("data-words"));
  const wait = txtElement.getAttribute("data-wait");
  // Init TypeWriter
  new TypeWriter(txtElement, words, wait);
}
