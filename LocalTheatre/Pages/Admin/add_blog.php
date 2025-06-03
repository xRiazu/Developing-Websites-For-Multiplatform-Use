<?php 
    include 'Components/header.php';
    include 'Database/config.php';
    if(!isset($_SESSION['loggedin'])){
         header('Location: login');
    }

?>

<main class="upload container mx-auto p-6">
	<h1 class="text-2xl font-bold text-center mb-6"></h1>
    <?php if(isset($_SESSION['statusMsg'])) : ?>
        <h4 class="text-center text-green-500 font-semibold"><?= $_SESSION['statusMsg'] ?></h4>
    <?php endif ?>
<h2 class="header text-xl font-semibold text-gray-700 text-center"> Add a new blog </h2>
<section class="uploadVinyl bg-white shadow-md rounded-lg p-6 mt-4">
    <form action="<?= ROOT_DIR ?>admin/upload-blog" method="post" enctype="multipart/form-data" class="space-y-4">
        <label for="imgUpload" class="block text-gray-600">Select Album Image</label>
        <input type="file" name="image_url" id="imgUpload" class="block w-full border rounded p-2">
       
        <label for="blogTitle" class="block text-gray-600">Blog Title</label>    
        <input type="text" name="title" id="blogTitle" required class="block w-full border rounded p-2">
       
        <label for="blogContent" class="block text-gray-600">Blog Content</label>    
        <textarea name="content" id="blogContent" class="block w-full border rounded p-2"></textarea>
      
        <label for="audioUrl" class="block text-gray-600">Blog Image</label>    
        <input type="text" name="audio_url" id="audioUrl" class="block w-full border rounded p-2">

        
        <input type="submit" name="submit" value="Upload" class="bg-blue-500 text-white font-bold py-2 px-4 rounded cursor-pointer hover:bg-blue-600">
    </form>
</section>
</main>
<h1 class="text-2xl font-bold text-center mt-6">User uploads</h1>
<?php include 'Components/footer.php'; ?>