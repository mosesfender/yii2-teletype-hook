document.addEventListener('DOMContentLoaded', function () {
    var refresh = function () {
        setInterval(function () {
            fetch('/teletype/test-page', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
            }).then(function (res) {
                if (res.ok) {
                    return res.json();
                }
            }).then(function (res) {
                clientText.value = res.client;
                operatorText.value = res.operator;
            });
        }, 5000);
    };
    var clientText = document.getElementById('client_log');
    var operatorText = document.getElementById('operator_log');
    refresh();
});
