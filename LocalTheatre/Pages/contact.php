<?php
include 'Components/header.php';
?>

<div class="min-h-screen bg-gray-800 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
            class="absolute inset-0 bg-gradient-to-r from-yellow-800 to-yellow-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="text-white relative px-4 py-10 yellow-500 shadow-lg sm:rounded-3xl sm:p-20">

            <div class="text-center pb-6">
                <h1 class="text-3xl">Contact Us!</h1>

                <p class="text-gray-300">
                    Fill up the form below to send us a message.
                </p>
            </div>

            <form>

                <input
                        class="shadow mb-4 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Name" name="name">

                <input
                        class="shadow mb-4 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="email" placeholder="Email" name="email">

                <input
                        class="shadow mb-4 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Subject" name="_subject">

                <textarea
                        class="shadow mb-4 min-h-0 appearance-none border rounded h-64 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Type your message here..." name="message" style="height: 121px;"></textarea>

                <div class="flex justify-between">
                    <input
                        class="shadow bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit" value="Send ➤">
                    <input
                        class="shadow bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="reset">
                </div>

            </form>
        </div>
    </div>
</div>
<?php
include 'Components/footer.php';
?>