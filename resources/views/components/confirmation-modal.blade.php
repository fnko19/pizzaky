<!-- Modal for confirming receipt of order -->
<div id="confirmationModal" class="fixed inset-0 hidden bg-black/50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-900">
                Konfirmasi Penerimaan
            </h3>
            <p class="text-sm text-gray-500 mt-2">
                Pesanan Anda Sudah Diterima? Setelah dikonfirmasi, pesanan akan dianggap selesai.
            </p>
        </div>
        
        <div class="mt-5 flex justify-end gap-3">
            <button type="button" onclick="closeConfirmationModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Batal
            </button>
            <form id="confirmReceiptForm" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Ya, Terima
                </button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript moved to main page -->
