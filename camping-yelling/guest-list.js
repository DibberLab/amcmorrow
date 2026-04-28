// Handle search filter
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const table = document.getElementById('guest-table');
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;
                
                cells.forEach(cell => {
                    const cellText = cell.textContent.toLowerCase();
                    if (cellText.indexOf(searchValue) > -1) {
                        found = true;
                    }
                });
                
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});

// Sort table function
function sortTable(field) {
    const urlParams = new URLSearchParams(window.location.search);
    const currentSort = urlParams.get('sort') || 'name';
    const currentOrder = urlParams.get('order') || 'asc';
    
    let newOrder = 'asc';
    if (field === currentSort && currentOrder === 'asc') {
        newOrder = 'desc';
    }
    
    window.location.href = `?sort=${field}&order=${newOrder}`;
}

// Export to CSV function
function exportToCSV() {
    const table = document.getElementById('guest-table');
    let csv = [];
    const rows = table.querySelectorAll('tr');
    
    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        
        // Skip the last column (actions)
        for (let i = 0; i < cols.length - 1; i++) {
            // Clean the text - remove newlines and quotes
            let text = cols[i].innerText.replace(/(\r\n|\n|\r)/gm, ' ').replace(/"/g, '""');
            // Add quotes around the text to properly handle commas
            rowData.push('"' + text + '"');
        }
        
        csv.push(rowData.join(','));
    });
    
    const csvContent = "data:text/csv;charset=utf-8," + csv.join('\n');
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', 'tubing_event_guest_list.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}