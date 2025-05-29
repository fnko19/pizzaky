// Test script for order status page modals
console.log('Order Status Page Test Script Loaded');

// Function to test the modals
function testOrderStatusModals() {
    console.log('Testing Order Status Modals');
    
    // Test if the confirmation modal functions exist
    if (typeof openConfirmationModal === 'function') {
        console.log('✅ openConfirmationModal function exists');
    } else {
        console.log('❌ openConfirmationModal function is missing');
    }
    
    if (typeof closeConfirmationModal === 'function') {
        console.log('✅ closeConfirmationModal function exists');
    } else {
        console.log('❌ closeConfirmationModal function is missing');
    }
    
    // Test if the cancellation modal functions exist
    if (typeof openCancellationModal === 'function') {
        console.log('✅ openCancellationModal function exists');
    } else {
        console.log('❌ openCancellationModal function is missing');
    }
    
    if (typeof closeCancellationModal === 'function') {
        console.log('✅ closeCancellationModal function exists');
    } else {
        console.log('❌ closeCancellationModal function is missing');
    }
    
    // Test if the generic closeModal function exists
    if (typeof closeModal === 'function') {
        console.log('✅ closeModal function exists');
    } else {
        console.log('❌ closeModal function is missing');
    }
    
    console.log('Test complete. Check the browser console for results.');
}

// Run the test after the page has loaded
window.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded, running tests...');
    
    // Add a test button to the page
    const testButton = document.createElement('button');
    testButton.textContent = 'Test Order Status Page';
    testButton.className = 'px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 fixed bottom-4 right-4';
    testButton.onclick = testOrderStatusModals;
    document.body.appendChild(testButton);
});
