<?php
$errrors = [];
$username = '';
$email = '';
$pass = '';
$confPass = '';
$link = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = postData('username');
    $email = postData('email');
    $pass = postData('pass');
    $confPass = postData('confPass');
    $link = postData('link');


    if (!$username) {
        $errors['username'] = 'Username is required';
    } elseif (strlen($username) < 6 || strlen($username) > 16) {
        $errors['username'] = 'Username must be between 6 and 16 characters';
    }

    if (!$email) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email must be valid';
    }

    if (!$pass) {
        $errors['pass'] = 'Password is required';
    }

    if (!$confPass) {
        $errors['confPass'] = 'Confirm Password is required';
    }
    if($pass && $confPass && strcmp($pass,$confPass)!==0){
        $errors['$confPass'] = 'NOT MATCH PASSWORD FIELD ';
    }

    if ($link && !filter_var($link,FILTER_VALIDATE_URL)) {
        $errors['link'] = 'PLEASE PROVIDE VAILD LINK';
    
    }

    if(empty($errors)){
        echo "NO ERROR";
    }
}

function postData($input)
{
    $_POST[$input] ??= '';
    return htmlspecialchars(stripslashes($_POST[$input]));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">

            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post">
                <div class="mb-4">
                    <label class=" block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="shadow appearance-none
                    border 
                    rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username" value="<?= $username ?>">
                    <?php if (isset($errors['username'])) : ?>
                        <p class="visible peer-invalid:visible text-red-700 font-light"> <?= $errors['username'] ?> </p>
                    <?php endif; ?>
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="<?= isset($errors['email']) ? 'invalid:border-red-500 ' : ''; ?> shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="Email" name="email" value='<?= $email ?>'>
                    <?php if (isset($errors['email'])) : ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors['email']; ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class=" <?= isset($errors['pass']) ? 'invalid:border-red-500 ' : ''; ?> shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="********" name="pass" value='<?= $pass ?>'>
                    <?php if (isset($errors['pass'])) : ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors['pass']; ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm-password">
                        Confirm Password
                    </label>
                    <input class="<?= isset($errors['confPass']) ? 'invalid:border-red-500 ' : ''; ?> shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirm-password" type="password" placeholder="********" name="confPass" value='<?= $confPass ?>'>
                    <?php if (isset($errors['confPass'])) : ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors['confPass']; ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="link">
                        Link
                    </label>
                    <input class="<?= isset($errors['link']) ? 'invalid:border-red-500 ' : ''; ?> shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="link" type="text" placeholder="Link" name="link" value="<?= $link ?>">
                    <?php if (isset($errors['link'])) : ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors['link']; ?></p>
                    <?php endif; ?>
                </div>


                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>