$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '1',
            lux1: 2666,
            lux2: null,
            lux3: 2647
        }, {
            period: '3',
            lux1: 2778,
            lux2: 2294,
            lux3: 2441
        }, {
            period: '6',
            lux1: 4912,
            lux2: 1969,
            lux3: 2501
        }, {
            period: '8',
            lux1: 3767,
            lux2: 3597,
            lux3: 5689
        }, {
            period: '10',
            lux1: 6810,
            lux2: 1914,
            lux3: 2293
        }, {
            period: '12',
            lux1: 5670,
            lux2: 4293,
            lux3: 1881
        }, {
            period: '14',
            lux1: 4820,
            lux2: 3795,
            lux3: 1588
        }, {
            period: '18',
            lux1: 15073,
            lux2: 5967,
            lux3: 5175
        }, {
            period: '20',
            lux1: 10687,
            lux2: 4460,
            lux3: 2028
        }, {
            period: '23',
            lux1: 8432,
            lux2: 5713,
            lux3: 1791
        }],
        xkey: 'period',
        ykeys: ['lux1', 'lux2', 'lux3'],
        labels: ['lux1', 'lux2', 'lux3'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Peak Usage",
            value: 30
        }, {
            label: "Off Peak Ussage",
            value: 10
        }, {
            label: "Power off",
            value: 60
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Jan',
            a: 70,
            b: 12
        }, {
            y: 'Feb',
            a: 67,
            b: 15
        }, {
            y: 'Mar',
            a: 70,
            b: 12
        }, {
            y: 'Apr',
            a: 80,
            b: 15
        }, {
            y: 'May',
            a: 78,
            b: 13
        }, {
            y: 'Jun',
            a: 54,
            b: 13
        }, {
            y: 'Jul',
            a: 61,
            b: 14
        }, {
            y: 'Aug',
            a: 59,
            b: 17
        }, {
            y: 'Sep',
            a: 82,
            b: 14
        }, {
            y: 'Oct',
            a: 75,
            b: 15
        }, {
            y: 'Nov',
            a: 83,
            b: 17
        }, {
            y: 'Dec',
            a: 67,
            b: 12
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
