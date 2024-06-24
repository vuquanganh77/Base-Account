$(document).ready(function() {
    // Khi bam vao nut edit 
    $('#editbtn').click(function() {
        $('.model').css('transform', 'scale(1)');
    });

    $('#editbtn').click(function() {
        $('#main').css('background', 'rgba(0, 0, 0, 0.3)');
    });

    // Khi bam vao nut cancel
    $('#close').click(function() {
        $('.model').css('transform', 'scale(0)');
    });

    $('#close').click(function() {
        $('#main').css('background', '');
    });

});