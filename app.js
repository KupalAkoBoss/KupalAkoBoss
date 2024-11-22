let previousRate = null;

async function fetchRate() {
    try {
    const response = await fetch('https://api.coindesk.com/v1/bpi/currentprice/BTC.json');
    const data = await response.json();

    const rate = parseFloat(data.bpi.USD.rate.replace(',', ''));

    document.getElementById('rate').textContent = `$${rate.toFixed(2)}`;

    addRateToHistory(rate);

    displayTrend(rate);

    previousRate = rate;
    } catch (error) {
        console.error('Error fetching data:', error);
        document.getElementById('rate').textContent = 'Error loading data';
    }
}

function addRateToHistory(rate) {
    const historyList = document.getElementById('rate-history');
    const listItem = document.createElement('li');
    listItem.classList.add('list-group-item');
    listItem.textContent = `$${rate.toFixed(2)} at ${new Date().toLocaleTimeString()}`;
    historyList.insertBefore(listItem, historyList.firstChild);

    if (historyList.children.length > 10) {
        historyList.removeChild(historyList.lastChild);
    }
}

function displayTrend(currentRate) {
    const trendElement = document.getElementById('trend');
    if (previousRate !== null) {
        if (currentRate > previousRate) {
        trendElement.textContent = 'Price is going up!';
        trendElement.classList.remove('down');
        trendElement.classList.add('up');
        } else if (currentRate < previousRate) {
        trendElement.textContent = 'Price is going down!';
        trendElement.classList.remove('up');
        trendElement.classList.add('down');
        } else {
        trendElement.textContent = 'Price is stable.';
        trendElement.classList.remove('up', 'down');
        }
    } else {
        trendElement.textContent = 'Waiting for data...';
    }
}

fetchRate();
setInterval(fetchRate, 10000);
