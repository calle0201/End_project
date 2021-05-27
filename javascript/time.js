updateClock();
setInterval(() => {
    updateClock()
}, 
    1000
);
function updateClock() {
    var fromGraduationDate = moment("20210609", "YYYYMMDD").fromNow(); 
    var currentTime = moment().format('LTS');
    document.getElementById('grad').innerHTML = fromGraduationDate;
    document.getElementById('current').innerHTML = currentTime;
    
}