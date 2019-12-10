<head>
  <meta charset="utf-8">
  <title>Registro</title>
  <link rel="stylesheet" href="../sauce/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1,
          shrink-to-fit=no">
</head>

<body>

  <?php
  include 'navbar_admin.php';
  ?>
 <div class="container p-5">
    <div class="row p-2">
      <div class="col-md-6">
        <button class="btn-b peach-gradient btn-block p-3">Sedes</button><br>
        <button class="btn-b blue-gradient btn-block p-3">Facilitadores</button>
      </div>
      <div class="col-md-6">
      <button class="btn-b purple-gradient btn-block p-3">Peridos</button><br>
        <button class="btn-b aqua-gradient btn-block p-3">---</button>
      </div>
    </div>
  </div>


  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.2.3/firebase-analytics.js"></script>
  <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyCOnEvFwCfDfM7gpX2DiKZTxtXSNljU_Jw",
      authDomain: "axios-c524e.firebaseapp.com",
      databaseURL: "https://axios-c524e.firebaseio.com",
      projectId: "axios-c524e",
      storageBucket: "axios-c524e.appspot.com",
      messagingSenderId: "1038331624441",
      appId: "1:1038331624441:web:17d779f7c09e12d9b61b28",
      measurementId: "G-RC4MZLVKQT"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <script>
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        var displayName = user.displayName;
        var email = user.email;
        var emailVerified = user.emailVerified;
        var photoURL = user.photoURL;
        var isAnonymous = user.isAnonymous;
        var uid = user.uid;
        var providerData = user.providerData;

      } else {
        window.location.href = "index.php";
      }
    });

    function cerrar() {
      firebase.auth().signOut()
        .then(function() {
          console.log("Salir");
        })
        .catch(function(error) {
          console.log(error);
        })
    }
  </script>

  <script>
    const signUpForm = document.querySelector('#form-signup');
    signUpForm.addEventListener('submit', (e) => {
      e.preventDefault();

      // Obtener info
      const email = signUpForm['inputEmail'].value;
      const password = signUpForm['inputPassword'].value;

      console.log(email + " " + password);

      firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        alert(errorMessage + " " + errorCode);
      });
    })
  </script>
</body>