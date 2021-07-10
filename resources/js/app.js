require('./bootstrap')

if (typeof $('[title]').data('placement') === 'undefined') {
    $('[title]').tooltip({
        placement: 'left'
    })
} else {
    $('[title]').tooltip()
}
