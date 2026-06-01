/**
 * Bluetooth Print Helper
 * Alternative methods for printing to thermal printers
 */

// Method 1: Using QZ Tray (Recommended for production)
async function printViaQZTray(receiptText) {
    try {
        // Check if QZ Tray is installed
        if (typeof qz === 'undefined') {
            throw new Error('QZ Tray not installed');
        }
        
        // Connect to QZ Tray
        if (!qz.websocket.isActive()) {
            await qz.websocket.connect();
        }
        
        // Find Bluetooth printer
        const printers = await qz.printers.find();
        console.log('Available printers:', printers);
        
        // Look for Bluetooth printer (usually contains "Bluetooth" in name)
        let printerName = printers.find(p => 
            p.toLowerCase().includes('bluetooth') || 
            p.toLowerCase().includes('pos') ||
            p.toLowerCase().includes('thermal')
        );
        
        if (!printerName) {
            printerName = printers[0]; // Use first printer as fallback
        }
        
        // Configure print job
        const config = qz.configs.create(printerName);
        
        // Send raw ESC/POS commands
        const data = [{
            type: 'raw',
            format: 'plain',
            data: receiptText
        }];
        
        await qz.print(config, data);
        
        return { success: true, message: 'Print successful via QZ Tray' };
        
    } catch (error) {
        console.error('QZ Tray error:', error);
        throw error;
    }
}

// Method 2: Using Android WebView (for mobile apps)
function printViaAndroid(receiptText) {
    try {
        if (typeof Android !== 'undefined' && Android.print) {
            Android.print(receiptText);
            return { success: true, message: 'Print sent to Android' };
        } else {
            throw new Error('Android interface not available');
        }
    } catch (error) {
        console.error('Android print error:', error);
        throw error;
    }
}

// Method 3: Download as text file (fallback)
function downloadReceipt(receiptText, filename = 'struk.txt') {
    const blob = new Blob([receiptText], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    return { success: true, message: 'Receipt downloaded' };
}

// Method 4: Copy to clipboard
async function copyReceiptToClipboard(receiptText) {
    try {
        await navigator.clipboard.writeText(receiptText);
        return { success: true, message: 'Receipt copied to clipboard' };
    } catch (error) {
        console.error('Clipboard error:', error);
        throw error;
    }
}

// Export functions
window.BluetoothPrintHelper = {
    printViaQZTray,
    printViaAndroid,
    downloadReceipt,
    copyReceiptToClipboard
};
