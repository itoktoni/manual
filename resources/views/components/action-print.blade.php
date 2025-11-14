@if(request()->get('action') == 'excel')
    @php
        $name = request()->get('report_name') ? request()->get('report_name').'.xls' : 'excel.xls';
        header('Content-Type: application/force-download');
        header('Content-disposition: attachment; filename='.$name);
        header("Pragma: ");
        header("Cache-Control: ");
    @endphp
@else
    @php
        // Store current URL as previous URL for future reference
        session(['previous_url' => url()->previous()]);

        $previousUrl = session('previous_url', route(module('index')));
        $currentUrl = url()->current();
        $showBackToPrevious = $previousUrl !== $currentUrl && !empty($previousUrl);

        $reportName = request()->get('report_name', 'report');
    @endphp

    <div class="header-action">
        <nav>
            @if($showBackToPrevious)
                <a href="{{ $previousUrl }}">← Back to Previous</a>
                <span class="separator">|</span>
            @endif
            <a href="{{ route(module('index')) }}">Back to List</a>
            <a class="cursor" onclick="window.print()">Print</a>
            <a href="javascript:void(0)" onclick="downloadExcel('{{ $reportName }}')" class="excel-download">Excel</a>
        </nav>
    </div>

    <script>
        function downloadExcel(reportName) {
            // Create a temporary div to clone the report content
            const tempDiv = document.createElement('div');
            tempDiv.style.position = 'absolute';
            tempDiv.style.left = '-9999px';
            tempDiv.style.top = '-9999px';

            // Find the report content (adjust selector based on your page structure)
            const reportContent = document.querySelector('.container') ||
                                 document.querySelector('.card-body') ||
                                 document.querySelector('table') ||
                                 document.body;

            // Clone the content
            const clonedContent = reportContent.cloneNode(true);

            // Create the Excel content
            let excelContent = '<html><head><meta charset="UTF-8"><style>';
            excelContent += `
                body { font-family: Arial, sans-serif; }
                h1 {font-size:13pt;margin:0;padding-bottom:2rem;margin-bottom:50px}
                img {float:right;max-width:150px;height:70px}
                h2,h3,h4 {font-size:11pt;margin:0}
                table { border-collapse: collapse; width: 100%;}
                #export th, #export td { border: 0.8px solid #000; padding: 8px; text-align: left; }
                #export th { background-color: #f2f2f2; }
                .invoice-header{margin-bottom:10px}
                .text-right {text-align:right}
                .header { text-align: center; font-weight: bold; margin-bottom: 10px; }
            `;
            excelContent += '</style></head><body>';

            // Add title

            // Add the content
            excelContent += clonedContent.innerHTML;
            excelContent += '</body></html>';

            // Create download link
            const blob = new Blob([excelContent], { type: 'application/vnd.ms-excel' });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = (reportName || 'report') + '.xls';

            // Trigger download
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Clean up
            window.URL.revokeObjectURL(link.href);
        }

        // Alternative function using table2excel library (if available)
        function downloadExcelAdvanced(reportName) {
            if (typeof jQuery !== 'undefined' && jQuery.fn.table2excel) {
                // Use table2excel plugin if available
                $('.table-responsive table').table2excel({
                    exclude: ".noExl",
                    name: reportName || "Report",
                    filename: (reportName || "report") + ".xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true
                });
            } else {
                // Fallback to basic Excel generation
                downloadExcel(reportName);
            }
        }

        // Function to handle complex tables with formatting
        function downloadFormattedExcel(reportName) {
            const tables = document.querySelectorAll('table');
            if (tables.length === 0) {
                downloadExcel(reportName);
                return;
            }

            let excelContent = '<html><head><meta charset="UTF-8"><style>';
            excelContent += `
                body { font-family: Arial, sans-serif; margin: 20px; }
                table { border-collapse: collapse; width: 100%; margin-bottom: 20px;margin-top:10px }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; font-weight: bold; }
                .header { text-align: center; font-weight: bold; margin-bottom: 10px; }
                .subtotal { background-color: #f9f9f9; font-weight: bold; }
                .total { background-color: #e6e6e6; font-weight: bold; }
            `;
            excelContent += '</style></head><body>';

            // Add title
            excelContent += '<div class="header"><h1>' + (reportName || 'Report') + '</h1>';
            excelContent += '<p>Generated on: ' + new Date().toLocaleDateString() + '</p></div>';

            // Process each table
            tables.forEach((table, index) => {
                if (index > 0) excelContent += '<br><br>';

                // Clone and clean the table
                const clonedTable = table.cloneNode(true);

                // Remove action buttons and non-essential elements
                const buttons = clonedTable.querySelectorAll('.btn, .action, .noExl');
                buttons.forEach(btn => btn.remove());

                excelContent += clonedTable.outerHTML;
            });

            excelContent += '</body></html>';

            // Download the file
            const blob = new Blob([excelContent], { type: 'application/vnd.ms-excel' });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = (reportName || 'report') + '.xls';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            window.URL.revokeObjectURL(link.href);
        }
    </script>
@endif
