$(document).ready(async function () {

    //get first
    await fetch("http://127.0.0.1:8000/api/getshow")
        .then(res => res.json())
        .then(async film => {
            let index = 1;

            for (let i of film) {
                let count = 0

                await fetch(`http://127.0.0.1:8000/api/getseat/${i.ShowID}`)
                    .then(res => res.json())
                    .then(seat => {
                        if (seat.length) {
                            for (y of seat) {
                                count += y.Seat.split(", ").length
                            }
                        }
                    })

                $(".table").append(`
                <tr class='info-s'>
                    <td>${index}</td> 
                    <td>${i.Name}</td>
                    <td>${new Date(i.Date).toLocaleDateString('pt-PT')}</td>
                    <td>${i.StartTime}</td>
                    <td>${i.Type}</td>
                    <td>${count}</td>
                    <td>${150 - count}</td>
                </tr>
                `)
                index++;

            }

        })

    //filter action
    $(".show-stat").click(async function () {
        $(".info-s").remove()

        await fetch("http://127.0.0.1:8000/api/getshow")
            .then(res => res.json())
            .then(async film => {
                let index = 1;
                start = new Date($("#start").val())
                end = new Date($("#end").val())

                for (let i of film) {
                    date = new Date(i.Date)

                    if ((date >= start) && (date <= end)) {
                        let count = 0

                        await fetch(`http://127.0.0.1:8000/api/getseat/${i.ShowID}`)
                            .then(res => res.json())
                            .then(seat => {
                                if (seat.length) {
                                    for (y of seat) {
                                        count += y.Seat.split(", ").length
                                    }
                                }
                            })

                        $(".table").append(`
                    <tr class='info-s'>
                        <td>${index}</td> 
                        <td>${i.Name}</td>
                        <td>${new Date(i.Date).toLocaleDateString('pt-PT')}</td>
                        <td>${i.StartTime}</td>
                        <td>${i.Type}</td>
                        <td>${count}</td>
                        <td>${150 - count}</td>
                    </tr>
                    `)
                        index++;

                    }
                }

            })
    })
})
