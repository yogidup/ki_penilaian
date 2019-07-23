
    // $('#tables table tbody tr').on('change', function(){

    //     var totals;
    //     var sum = 0;
    //     $(this).each(function(){
    //         var numb1 = $(this).find('.numb1').text();
    //         var numb2 = $(this).find('select').val()
    //         var totalRow = $(this).find('td.hasil');

    //         var x = parseInt(numb1);
    //         var y = parseInt(numb2);
    //         var hasil = x * y;
    //         sum = sum +  hasil;
    //         totalRow.html(hasil);
    //     });

    //     totals = 0 + sum;
    //     total(totals)
        
    // });


$('#tables table tbody tr').each(function(){
    calculate();
})

function calculate(){

    var sum = 0;
    $('#tables table tbody tr').each(function(){
        var numb1 = $(this).find('.numb1').text();
        var numb2 = $(this).find('select').val()
        var totalRow = $(this).find('td.hasil');

        var x = parseInt(numb1);
        var y = parseInt(numb2);
        var hasil = x * y;
        sum = sum +  hasil;
        totalRow.html(hasil);
    });

    $('.total-penilaian').html(sum);

}





//  $('#tables table tbody tr td.hasil').on('change', function(){
//     var xs = $(this).html();
//     var ds = parseInt(xs);

//     var totals = 0 + ds;
//     console.log(totals)
//  });