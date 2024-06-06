interface ITestData
{
    client: string;
    operator: string;
}

document.addEventListener('DOMContentLoaded', () => {
    let refresh = () => {
        setInterval(() => {
            fetch('/teletype/test-page', {
                method : 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
            }).then((res: Response) => {
                if (res.ok) {
                    return res.json();
                }
            }).then((res: ITestData) => {
                clientText.value   = res.client;
                operatorText.value = res.operator;
            });
        }, 5000);
    }
    
    let clientText   = document.getElementById('client_log') as HTMLTextAreaElement;
    let operatorText = document.getElementById('operator_log') as HTMLTextAreaElement;
    
    refresh();
});