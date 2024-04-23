$(function () {
    new ApexCharts(document.querySelector("#salesOverview2"), {
        chart: {
            height: 400,
            type: "area",
            animations: {
                enabled: !0,
                easing: "easeinout",
                speed: 1e3
            },
            dropShadow: {
                enabled: !0,
                opacity: .3,
                blur: 3,
                left: -5,
                top: 18
            },
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !1
            }
        },
        colors: ["#0652DD", "#dc3545"],
        dataLabels: {
            enabled: !1
        },
        fill: {
            type: "gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !0,
                opacityFrom: .1,
                opacityTo: 0,
                stops: [40, 100]
            }
        },
        grid: {
            borderColor: "#f3f3f4",
            strokeDashArray: 4,
            xaxis: {
                lines: {
                    show: !0
                }
            },
            yaxis: {
                lines: {
                    show: !1
                }
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        legend: {
            position: "top",
            horizontalAlign: "right",
            offsetY: -60,
            fontSize: "14px",
            markers: {
                width: 9,
                height: 9,
                strokeWidth: 0,
                radius: 20
            },
            itemMargin: {
                horizontal: 5,
                vertical: 0
            }
        },
        title: {
            text: "$9999.36",
            align: "left",
            margin: 0,
            offsetX: -10,
            offsetY: 20,
            floating: !1,
            style: {
                fontSize: "16px",
                color: "#383663"
            }
        },
        tooltip: {
            theme: "light",
            marker: {
                show: !0
            },
            x: {
                show: !1
            }
        },
        subtitle: {
            text: "Total Sales",
            align: "left",
            margin: 0,
            offsetX: -10,
            offsetY: 0,
            floating: !1,
            style: {
                fontSize: "14px",
                color: "#8380ae"
            }
        },
        stroke: {
            show: !0,
            curve: "smooth",
            width: 4
        },
        series: [{
            name: "Sales",
            data: [4200, 4600, 4200, 3800, 4500, 4300, 3800, 4900, 4600, 4300, 4800, 5100]
        }, {
            name: "Cost",
            data: [4300, 4800, 3900, 3600, 4300, 3700, 4e3, 4200, 3800, 3900, 4100, 3600]
        }],
        xaxis: {
            crosshairs: {
                show: !0
            },
            labels: {
                offsetX: 0,
                offsetY: 5,
                style: {
                    colors: "#8380ae",
                    fontSize: "12px",
                    fontFamily: "Inter, sans-serif"
                }
            },
            tooltip: {
                enabled: !1
            }
        },
        yaxis: {
            labels: {
                formatter: function (e, t) {
                    return e / 1e3 + "K"
                },
                offsetX: -10,
                offsetY: 0,
                style: {
                    colors: "#8380ae",
                    fontSize: "12px",
                    fontFamily: "Inter, sans-serif"
                }
            }
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 250
                },
                legend: {
                    position: "bottom",
                    offsetY: 0
                }
            }
        }]
    }).render(), new ApexCharts(document.querySelector("#pageViews"), {
        chart: {
            height: 40,
            type: "area",
            dropShadow: {
                enabled: !0,
                opacity: .1,
                blur: 2,
                left: -1,
                top: 5
            },
            responsive: !0,
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !1
            },
            animations: {
                enabled: !0,
                easing: "easeinout",
                speed: 800
            },
            sparkline: {
                enabled: !0
            }
        },
        colors: ["#0652DD"],
        dataLabels: {
            enabled: !1
        },
        fill: {
            type: "solid",
            opacity: 0
        },
        tooltip: {
            theme: "light",
            style: {
                fontSize: "12px",
                fontFamily: "Inter, sans-serif"
            },
            marker: {
                show: !1
            },
            x: {
                show: !0
            }
        },
        stroke: {
            show: !0,
            curve: "smooth",
            width: 3
        },
        series: [{
            name: "Pageviews",
            data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
        }],
        labels: ["1 Apr 20", "2 Apr 20", "3 Apr 20", "4 Apr 20", "5 Apr 20", "6 Apr 20", "7 Apr 20", "8 Apr 20", "9 Apr 20", "10 Apr 20", "11 Apr 20"]
    }).render(), new ApexCharts(document.querySelector("#revenueBar"), {
        chart: {
            type: "bar",
            height: 40,
            sparkline: {
                enabled: !0
            },
            dropShadow: {
                enabled: !0,
                opacity: .1,
                blur: 2,
                left: -1,
                top: 5
            }
        },
        colors: ["#0652DD", "#383663"],
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: "50%"
            }
        },
        dataLabels: {
            enabled: !1
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: "light",
            style: {
                fontSize: "12px"
            },
            marker: {
                show: !1
            },
            x: {
                show: !1
            }
        },
        series: [{
            name: "Profit",
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
            name: "Revenue",
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }]
    }).render()
});