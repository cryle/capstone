function printDiv() {
    var divToPrint = document.getElementById('div-to-print');
    var printContents = divToPrint.innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();

    document.body.innerHTML = originalContents;
}