<?php 
session_start(); 
include '../config.php';

if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);

  $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$username'")
            or die('Ada kesalahan pada query: '.mysqli_error($mysqli));

  if ($data = mysqli_fetch_assoc($query)) {
    if ($data['password'] === $password) {
      $_SESSION['id_user'] = $data['id_user'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['role'] = $data['role'];

      if ($data['role'] === 'admin') {
        header("Location: ../admin/surat_masuk/surat_masuk.php");
      } else {
        header("Location: ../user/surat_masuk/main.php");
      }
      exit();
    } else {
      $_SESSION['error'] = "Password salah!";
    }
  } else {
    $_SESSION['error'] = "Username tidak ditemukan!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - LawRegister</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <style>
    :root {
      --primary-color: #3b63d3;
      --primary-hover: #2c4eb4;
      --primary-focus: rgba(59, 99, 211, 0.25);
      --primary-light: rgba(59, 99, 211, 0.1);
    }
    
    body {
      font-family: 'Outfit', sans-serif;
      background-color: #f3f4f8;
    }
    
    .premium-shadow {
      box-shadow: 0 20px 60px -15px rgba(0, 0, 0, 0.1), 
                  0 5px 25px -10px rgba(0, 0, 0, 0.05);
    }
    
    .input-field:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 4px var(--primary-focus);
    }
    
    .premium-gradient {
      background: linear-gradient(135deg, #4568dc 0%, #3543c9 100%);
    }
    
    .animated-bg {
      background-size: 400% 400%;
      animation: gradient 10s ease infinite;
    }
    
    @keyframes gradient {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }
    
    .animated-pattern {
      animation: float 10s ease-in-out infinite;
    }
    
    @keyframes float {
      0% { transform: translateY(0px) translateX(0px); }
      50% { transform: translateY(-10px) translateX(10px); }
      100% { transform: translateY(0px) translateX(0px); }
    }
    
    @media (max-width: 767px) {
      .card-shift {
        margin-top: -40px;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
      }
    }

    .custom-checkbox {
      appearance: none;
      width: 18px;
      height: 18px;
      border-radius: 5px;
      border: 2px solid #d1d5db;
      position: relative;
      transition: all 0.2s ease;
      cursor: pointer;
    }
    
    .custom-checkbox:checked {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .custom-checkbox:checked::after {
      content: "✓";
      font-size: 12px;
      color: white;
      position: absolute;
      top: 0px;
      left: 3px;
    }
    
    .custom-checkbox:focus {
      box-shadow: 0 0 0 3px var(--primary-focus);
      outline: none;
    }
    
    /* Tambahan untuk memastikan tombol login selalu terlihat */
    #loginButton {
      display: flex !important;
      visibility: visible !important;
      opacity: 1 !important;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="min-h-screen flex flex-col md:flex-row md:items-center md:justify-center p-0 md:p-5 lg:p-10">
    
    <div class="flex flex-col md:flex-row w-full max-w-6xl premium-shadow md:rounded-3xl overflow-hidden bg-white relative">
      
      <div class="md:w-5/12 premium-gradient animated-bg relative h-[260px] sm:h-[300px] md:h-auto overflow-hidden">
        <div class="absolute inset-0 opacity-20 animated-pattern">
          <svg width="100%" height="100%" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="1"/>
              </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
          </svg>
        </div>
        
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-8 py-12 z-10">
          <div class="text-center max-w-sm">
            <div class="mb-6 inline-block p-3 rounded-full bg-white/20 backdrop-blur-lg shadow-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
              </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3">LawRegister</h1>
            <div class="w-16 h-1 bg-white/70 mx-auto mb-6 rounded-full"></div>
            <p class="text-sm sm:text-base lg:text-lg text-blue-100 leading-relaxed">
              Solusi modern untuk pengelolaan surat masuk dan disposisi dengan sistem elektronik terintegrasi.
            </p>
          </div>
          
          <div class="hidden lg:block absolute bottom-6 right-6">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-10">
              <circle cx="60" cy="60" r="60" fill="white"/>
              <circle cx="60" cy="60" r="45" stroke="white" stroke-width="2"/>
              <circle cx="60" cy="60" r="30" stroke="white" stroke-width="2"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="md:w-7/12 p-6 sm:p-8 md:p-10 lg:p-14 flex items-center justify-center bg-white card-shift relative z-10">
        <form class="w-full max-w-md space-y-7" method="POST" action="" id="loginForm">
          <div class="text-center md:text-left mb-2">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Selamat Datang</h2>
            <p class="text-sm text-gray-500 mt-3">Silakan masukkan detail akun Anda untuk melanjutkan.</p>
          </div>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-50 text-red-600 text-sm font-medium p-4 rounded-xl border border-red-100 flex items-start animate-fade-in">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              <span><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
            </div>
          <?php endif; ?>

          <div class="space-y-5">
            <div class="form-group" id="usernameGroup">
              <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                  </svg>
                </div>
                <input type="text" name="username" id="username" required placeholder="Masukkan username"
                  class="input-field block w-full pl-12 pr-4 py-3.5 text-base border border-gray-300 rounded-xl focus:outline-none transition duration-200 text-gray-800 bg-gray-50/80 hover:bg-gray-50 focus:bg-white" />
              </div>
            </div>

            <div class="form-group" id="passwordGroup">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                  </svg>
                </div>
                <input type="password" name="password" id="password" required placeholder="Masukkan password"
                  class="input-field block w-full pl-12 pr-12 py-3.5 text-base border border-gray-300 rounded-xl focus:outline-none transition duration-200 text-gray-800 bg-gray-50/80 hover:bg-gray-50 focus:bg-white" />
                <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none p-1 rounded-full hover:bg-gray-100 transition-colors">
                  <img src="../image/hide.png" alt="show/hide" class="w-5 h-5" id="toggleIcon" />
                </button>
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="custom-checkbox">
                <label for="remember-me" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
              </div>
              <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-200 hover:underline">
                Lupa Password?
              </a>
            </div>
          </div>

          <button type="submit" id="loginButton" name="login" 
            class="w-full bg-blue-600 text-white py-3.5 rounded-xl font-semibold transition duration-200 flex justify-center items-center shadow-md hover:shadow-lg text-sm mt-6 focus:outline-none focus:ring-4 focus:ring-blue-500/30 hover:bg-blue-700">
            <span>Masuk ke Akun</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>

          <div class="pt-2 text-center">
            <p class="text-sm text-gray-600">
              Belum punya akun? 
              <a href="register.html" class="text-blue-600 hover:text-blue-800 font-medium transition duration-200 hover:underline">
                Daftar Sekarang
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>
    
    <div class="md:hidden text-center text-xs text-gray-500 mt-6 mb-4 px-6">
      <p>© 2025 LawRegister. All rights reserved.</p>
    </div>
  </div>

  <script>
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    togglePassword.addEventListener("click", () => {
      if (password.type === "password") {
        password.type = "text";
        icon.src = "../image/witness.png";
      } else {
        password.type = "password";
        icon.src = "../image/hide.png";
      }
    });
    
    document.addEventListener("DOMContentLoaded", function() {
      // Perbaikan animasi untuk memastikan tombol login tampil
      const formElementsExceptButton = document.querySelectorAll("#loginForm > *:not(#loginButton)");
      
      gsap.from(formElementsExceptButton, {
        y: 20,
        opacity: 0,
        duration: 0.6,
        stagger: 0.1,
        ease: "power2.out",
        delay: 0.2
      });
      
      // Animasi terpisah untuk tombol login
      gsap.from("#loginButton", {
        y: 20,
        opacity: 0,
        duration: 0.6,
        ease: "power2.out",
        delay: 0.8,
        onComplete: function() {
          // Memastikan tombol terlihat setelah animasi
          document.getElementById("loginButton").style.display = "flex";
          document.getElementById("loginButton").style.opacity = "1";
          document.getElementById("loginButton").style.visibility = "visible";
        }
      });
      
      const formGroups = document.querySelectorAll('.form-group');
      formGroups.forEach(group => {
        const input = group.querySelector('input');
        
        if (input) {
          input.addEventListener('focus', () => {
            gsap.to(group, {
              scale: 1.01,
              duration: 0.2,
              ease: "power1.out"
            });
          });
          
          input.addEventListener('blur', () => {
            gsap.to(group, {
              scale: 1,
              duration: 0.2,
              ease: "power1.out"
            });
          });
        }
      });
    });
  </script>
</body>
</html>