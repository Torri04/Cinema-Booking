$(document).ready(async function () {

    await fetch(`http://127.0.0.1:8000/api/gethistory/${$("#userid").val()}`)
        .then(res => res.json())
        .then(film => {
            let index = 1;

            for (let i of film) {
                $(".table").append(`
                <tr class='info-s'>
                    <td>${index}</td> 
                    <td>${i.Name}</td>
                    <td>${new Date(i.Date).toLocaleDateString('pt-PT')}</td>
                    <td>${i.StartTime}</td>
                    <td>${i.Seat}</td>
                    <td>${i.Total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</td>
                    <td>${i.PayCheck}</td>
                </tr>
                `)
                index++;

            }

        })

    $(".reser-stat").click(async function () {
        $(".info-s").remove()

        await fetch(`http://127.0.0.1:8000/api/gethistory/${$("#userid").val()}`)
            .then(res => res.json())
            .then(film => {
                let index = 1;
                start = new Date($("#start").val())
                end = new Date($("#end").val())

                for (let i of film) {
                    date = new Date(i.Date)

                    if ((date >= start) && (date <= end)) {
                        $(".table").append(`
                        <tr class='info-s'>
                            <td>${index}</td> 
                            <td>${i.Name}</td>
                            <td>${new Date(i.Date).toLocaleDateString('pt-PT')}</td>
                            <td>${i.StartTime}</td>
                            <td>${i.Seat}</td>
                            <td>${i.Total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</td>
                            <td>${i.PayCheck}</td>
                        </tr>
                        `)
                        index++;
                    }
                }

            })
    })
})
