<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Formulir Input Role -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Input Role</h2>
                <form action="index.php?modul=barang&fitur=editBarang&id=<?php echo $item->item_id; ?>" method="POST">
                    <!-- Nama Role -->
                    <div class="mb-4">
                        <label for="item_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Role:</label>
                        <input type="text" id="item_name" name="item_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Nama Role" required
                        value="<?php echo htmlspecialchars($item->item_name);?>">
                    </div>

                    <!-- Role Deskripsi -->
                    <div class="mb-4">
                        <label for="item_desc" class="block text-gray-700 text-sm font-bold mb-2">Role Deskripsi:</label>
                        <textarea id="item_desc" name="item_desc" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Deskripsi Role" rows="3" required
                        ><?php echo htmlspecialchars($item->item_desc);?></textarea>
                    </div>

                    <!-- Harga Barang -->
                    <div class="mb-4">
                        <label for="item_price" class="block text-gray-700 text-sm font-bold mb-2">Harga Barang:</label>
                        <input type="number" id="item_price" name="item_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Harga Barang" required value="<?php echo htmlspecialchars($item->hargaBarang);?>">
                    </div>

                    <!-- Role Status
                    <div class="mb-4">
                        <label for="item_status" class="block text-gray-700 text-sm font-bold mb-2">Role Status:</label>
                        <select id="item_status" name="item_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Pilih Status</option>
                            <option value=1 <?php echo ($item->item_status == 1) ?'selected' :'' ?>>Baru</option>
                            <option value=0 <?php echo ($item->item_status == 0) ?'selected' :'' ?>>Bekas</option>
                        </select>
                    </div> -->

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
