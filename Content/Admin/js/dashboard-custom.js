$(function () {
    var e = {
            series: [{
                name: "San Francisco",
                data: [70, 90, 41, 67, 120, 43]
            }, {
                name: "Diego",
                data: [28, 50, 33, 30, 13, 27]
            }, ],
            chart: {
                height: 200,
                type: "bar",
                foreColor: "#adb0bb",
                toolbar: {
                    show: !1
                },
                stacked: !0
            },
            colors: ["#0652DD", "#198754"],
            plotOptions: {
                bar: {
                    borderRadius: [6],
                    horizontal: !1,
                    barHeight: "60%",
                    columnWidth: "40%"
                }
            },
            stroke: {
                show: !1
            },
            dataLabels: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            grid: {
                show: !1
            },
            yaxis: {
                tickAmount: 4
            },
            xaxis: {
                categories: ["01", "02", "03", "04", "05", "06"],
                axisTicks: {
                    show: !1
                }
            },
            tooltip: {
                theme: "dark",
                fillSeriesColor: !1,
                x: {
                    show: !1
                }
            }
        },
        o = new ApexCharts(document.querySelector("#most-visited"), e);
    o.render();

    var e = {
            series: [{
                name: "Footware",
                data: [2.5, 2.7, 3.2, 2.6, 1.9]
            }, {
                name: "Fashionware",
                data: [-2.8, -1.1, -3, -1.5, -1.9]
            }, ],
            chart: {
                height: 200,
                type: "bar",
                toolbar: {
                    show: !1
                },
                offsetX: -20,
                stacked: !0
            },
            colors: ["#198754", "#0652DD"],
            plotOptions: {
                bar: {
                    horizontal: !1,
                    barHeight: "60%",
                    columnWidth: "20%",
                    borderRadius: [5],
                    borderRadiusApplication: "end",
                    borderRadiusWhenStacked: "all"
                }
            },
            stroke: {
                show: !1
            },
            dataLabels: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            grid: {
                show: !1
            },
            yaxis: {
                min: -5,
                max: 5,
                tickAmount: 4
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May"],
                axisTicks: {
                    show: !1
                }
            },
            tooltip: {
                theme: "dark"
            }
        },
        o = new ApexCharts(document.querySelector("#revenue-updates"), e);
    o.render();

    var e = {
            color: "#adb5bd",
            series: [38, 40, 25],
            labels: ["Expance", "Revenue", "Profit"],
            chart: {
                height: 230,
                type: "donut",
                foreColor: "#adb0bb"
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "89%",
                        background: "transparent",
                        labels: {
                            show: !0,
                            name: {
                                show: !0,
                                offsetY: 7
                            },
                            value: {
                                show: !1
                            },
                            total: {
                                show: !0,
                                color: "#5A6A85",
                                fontSize: "20px",
                                fontWeight: "600",
                                label: "$500,458"
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                show: !1
            },
            legend: {
                show: !1
            },
            colors: ["#0652DD", "#EAEFF4", "#198754"],
            tooltip: {
                theme: "dark",
                fillSeriesColor: !1
            }
        },
        o = new ApexCharts(document.querySelector("#sales-overview"), e);

    o.render(), new ApexCharts(document.querySelector("#OrderStatistics"), {
        chart: {
            height: 300,
            type: "bar",
            animations: {
                enabled: !0,
                easing: "easeinout",
                speed: 1e3
            },
            dropShadow: {
                enabled: !0,
                opacity: .1,
                blur: 2,
                left: -1,
                top: 5
            },
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                horizontal: !1,
                borderRadius: 3,
                columnWidth: "50%",
                endingShape: "rounded"
            }
        },
        colors: ["#0652DD", "#198754"],
        dataLabels: {
            enabled: !1
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
            offsetY: 0,
            fontSize: "14px",
            fontFamily: "Inter, sans-serif",
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
        tooltip: {
            theme: "light",
            marker: {
                show: !0
            },
            x: {
                show: !1
            }
        },
        stroke: {
            show: !0,
            colors: ["transparent"],
            width: 3
        },
        series: [{
            name: "Sales",
            data: [4200, 4600, 4200, 3800, 4500, 4300, 3800, 4900, 4600, 4e3, 4800, 5100]
        }, {
            name: "Revenue",
            data: [4900, 4800, 3900, 3600, 4e3, 3700, 4e3, 4200, 3800, 3900, 4100, 5900]
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
                    fontSize: "12px"
                }
            },
            tooltip: {
                enabled: !1
            }
        },
        yaxis: {
            labels: {
                formatter: function (e, o) {
                    return e / 1e3 + "K"
                },
                offsetX: -10,
                offsetY: 0,
                style: {
                    colors: "#8380ae",
                    fontSize: "12px"
                }
            }
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 230
                },
                plotOptions: {
                    bar: {
                        columnWidth: "70%"
                    }
                }
            }
        }]
    }).render();
    var t = {
            series: [44, 55, 67, 83],
            color: "#6D5D6E",
            chart: {
                height: 300,
                type: "radialBar"
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: "22px"
                        },
                        value: {
                            fontSize: "16px"
                        },
                        total: {
                            show: !0,
                            label: "Total",
                            formatter: function (e) {
                                return 249
                            }
                        }
                    }
                }
            },
            labels: ["Apples", "Oranges", "Bananas", "Berries"]
        },
        a = new ApexCharts(document.querySelector("#chart-donut"), t);
    a.render();
    
    var t = {
            series: [44, 55, 41, 17, 15],
            color: "#0652DD",
            chart: {
                type: "donut",
                height: 300
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }]
        },
        a = new ApexCharts(document.querySelector("#pie-chart"), t);
    a.render(), new ApexCharts(document.querySelector("#salesOverview2"), {
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
        colors: ["#007bff", "#dc3545"],
        dataLabels: {
            enabled: !1
        },
        fill: {
            type: "gradient",
            gradient: {
                type: "vertical",
                shadeIntensity: 1,
                inverseColors: !0,
                opacityFrom: .3,
                opacityTo: .1,
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
            text: "$21,637",
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
            text: "Total Income",
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
            width: 3
        },
        series: [{
            name: "Sales",
            data: [4200, 4600, 4200, 3800, 4500, 4300, 3800, 4900, 4600, 4300, 4800, 5100]
        }, {
            name: "Revenue",
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
                formatter: function (e, o) {
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
    }), new ApexCharts(document.querySelector("#pageViews"), {
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
    }), new ApexCharts(document.querySelector("#revenueBar"), {
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
    })
});