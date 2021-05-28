

//sets the clock once the site loads

window.onload = () => {updateClock();};

//starts an interval to change the clock every second
setInterval(() => {
    updateClock()
}, 
    1000
);
function updateClock() {
    //get how much time it is from / to this date
    var fromGraduationDate = moment("20210609", "YYYYMMDD").fromNow(); 
    //the current time in   HH:MM:SS
    var currentTime = moment().format('LTS');
    //update the element with the ID grad to the time that the var gives
    document.getElementById('grad').innerHTML = fromGraduationDate;
    //update the element with the ID current to the time that the var gives
    document.getElementById('current').innerHTML = currentTime;
}