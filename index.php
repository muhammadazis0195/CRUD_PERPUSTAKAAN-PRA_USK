<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERPUSTAKAAN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        .container{
            box-shadow: 3px 6px 17px black;
        }
        button {
          width: 10em;
          position: relative;
          height: 3.5em;
          border: 3px ridge #149CEA;
          outline: none;
          background-color: transparent;
          color: black;
          margin-top: 30px;
          margin-bottom: 40px;
          cursor: pointer;
          transition: 1s;
          border-radius: 0.3em;
          font-size: 16px;
          font-weight: bold;
        }

        button::after {
          content: "";
          position: absolute;
          top: -10px;
          left: 3%;
          width: 95%;
          height: 40%;
          background-color: #fff;
          transition: 0.5s;
          transform-origin: center;
        }

        button::before {
          content: "";
          transform-origin: center;
          position: absolute;
          top: 80%;
          left: 3%;
          width: 95%;
          height: 40%;
          background-color: #fff;
          transition: 0.5s;
        }

        button:hover::before, button:hover::after {
          transform: scale(0)
        }

        button:hover {
          box-shadow: inset 0px 0px 25px #1479EA;
        }
    </style>
</head>

<body style="background-image: url('bg3.png'); background-size: cover;">
    <div class="container" style="background-image: url('bg_login.png'); background-size: cover;  margin: 55px 70px; border-radius: 30px;">
        <div style="padding: 5px;">
            <center><a href="index.php"><img src="loginadmin/logo1.png"></a></center>

            <div>
                <center><h1 style="color:black; font-family: 'Oleo Script', cursive;">Welcome</h1></center>

                <center><h style="color:black; font-family: 'Rubik', sans-serif;">Choose your Account!</h></center>
            </div>
            <br>
            
            <div>
                <center>
                    <div style="display: flex; justify-content: center;">
                        <form action="loginadmin/login.php" style="margin-right: 40px;">
                            <button>Admin</button>
                        </form>
                        <form action="loginadmin/loginpus.php" style="margin-right: 40px;">
                            <button>Pustakawan</button>
                        </form>
                        <form action="home/login.php">
                            <button>Anggota</button>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>
</html>