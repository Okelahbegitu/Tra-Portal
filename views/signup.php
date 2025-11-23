<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tra-Portal</title>
    <link rel="stylesheet" href="../output.css?v=<?php echo time(); ?>">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        
        .full-screen-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-wrapper {
            flex: 1;
            display: flex;
            overflow: hidden;
        }
        
        .form-section, .display-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .form-input {
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(119, 136, 115, 0.3);
            outline: none;
        }
        
        .brand-bullet {
            width: 12px;
            height: 12px;
            background-color: #A1BC98;
            opacity: 0.4;
            border-radius: 50%;
            display: inline-block;
            margin: 0 4px;
        }
        
        .brand-bullet-active {
            background-color: #8B4513;
            opacity: 1;
            transform: scale(1.5);
        }
        
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 0 20px;
        }
    </style>
</head>

<body class="min-h-screen">
    <div class="full-screen-container">
        <header class="sticky top-0 z-50 bg-palette-3">
            <nav class="w-full flex justify-between text-white p-4">
                <h1 class="font-bold text-2xl">Tra-Portal</h1>
                <a href="index.php" class="p-3 font-bold bg-palette-4 rounded-3xl">Home</a>
            </nav>
        </header>

        <div class="content-wrapper">
            <!-- Left Section - Form -->
            <div class="form-section bg-palette-1">
                <div class="form-container">
                    <h1 class="text-4xl md:text-5xl font-black text-palette-4 mb-4">HELLO THERE</h1>
                    <p class="text-xl text-palette-3 mb-8">Create your account</p>

                    <form id="signupForm" class="space-y-6">
                        <div>
                            <label for="username" class="block text-palette-4 text-sm font-semibold mb-2">Username</label>
                            <input type="text" id="username" name="username" required
                                class="form-input px-4 py-3 border border-palette-3 rounded-lg bg-white text-gray-900 focus:border-palette-4">
                        </div>

                        <div>
                            <label for="email" class="block text-palette-4 text-sm font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                class="form-input px-4 py-3 border border-palette-3 rounded-lg bg-white text-gray-900 focus:border-palette-4">
                        </div>

                        <div>
                            <label for="password" class="block text-palette-4 text-sm font-semibold mb-2">Password</label>
                            <input type="password" id="password" name="password" required
                                class="form-input px-4 py-3 border border-palette-3 rounded-lg bg-white text-gray-900 focus:border-palette-4">
                        </div>

                        <button type="submit" class="w-full py-3 bg-palette-4 text-white text-base font-bold rounded-lg cursor-pointer hover:bg-opacity-90 transition-all duration-300 mt-6">
                            Register
                        </button>
                    </form>

                    <div class="text-center mt-6">
                        <a href="index.php" class="text-palette-4 font-semibold hover:opacity-75 transition-opacity duration-300 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Section - Display -->
            <div class="display-section bg-palette-3 relative">
                <div class="text-5xl md:text-6xl font-light text-white tracking-wider text-center">Display</div>
                <div class="absolute bottom-10 flex items-center">
                    <div class="brand-bullet brand-bullet-active"></div>
                    <div class="brand-bullet"></div>
                    <div class="brand-bullet"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>