@extends('cliente::template')
@section('style')
    <style>
            :root { --var-color-grey: #898989; }
        body { 
            margin:0; 
            position:fixed; 
            top:0; 
            right:0; 
            bottom:0; 
            left:0; 
            font-family: Helvetica; ; 
            }
    
        text {
            font-family: Helvetica;
            color: var(--var-color-grey);
        }
        .axis path,
        .axis line {
            fill: none;
            stroke: var(--var-color-grey);
            shape-rendering: crispEdges;
        }
        .x.axis {font-size: 15px;  }
        .y.axis {font-size: 12px; }
        div.tooltip {	
            position: absolute;			
            text-align: center;			
            width: 60px;					
            height: 28px;					
            padding: 2px;				
            font: 12px sans-serif;		
            background: lightsteelblue;	
            border: 0px;		
            border-radius: 8px;			
            pointer-events: none;			
        }

    </style>
@endsection
@section('content') 

    <div class="container">

        
        <div class="row">
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body ">
                    <h5 class="card-title">Média de Gasto por Compra</h5>
                    <div id='mediagasto'>
                        
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total de Clientes</h5>
                    <div id='totalclientes'>
                        
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total de Vendas</h5>
                    <div id='totalvendas'>
                        
                    </div>
                </div>
                </div>
            </div>
        </div>


        <div class="row mt-3">

            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Valor Total das Compras</h5>
                        <div id="totalCompras"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Produtos Vendidos</h5>
                        <div id="totalProdutos"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('script')

    <script src="https://d3js.org/d3.v5.min.js"></script>

    <script>

        $(document).ready(function(){


            //[{"month":"Jan", "value": .07}];
            
            $.get(main_url+"/cliente/dashboard/totalclientes/2019", function(dataset){
                $('#totalclientes').append(dataset);
            });
            $.get(main_url+"/cliente/dashboard/totalvendas/2019", function(dataset){
                $('#totalvendas').append(dataset);
            });
            $.get(main_url+"/cliente/dashboard/mediagasto/2019", function(dataset){
                $('#mediagasto').append(dataset);
            });
            $.get(main_url+"cliente/dashboard/totalvendasmes/2019", function(dataset){
                console.log(dataset);
            });

            // grafico("#totalCompras", dataset)
            // grafico("#totalProdutos", dataset)
        })

        function grafico(id, dataset){

            var margin = {top: 40, right: 30, bottom: 30, left: 50},
            width = 460 - margin.left - margin.right,
            height = 320 - margin.top - margin.bottom;

            var greyColor = "#898989";
            var barColor = d3.interpolateInferno(0.4);
            var highlightColor = d3.interpolateInferno(0.3);

            var formatPercent = d3.format(".0%");

            var svg = d3.select(id).append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
            .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

            var x = d3.scaleBand()
                .range([0, width])
                    .padding(0.4);
                    
            var y = d3.scaleLinear()
                .range([height, 0]);

            var xAxis = d3.axisBottom(x).tickSize([]).tickPadding(10);
            var yAxis = d3.axisLeft(y);

            var max = 0

            dataset.map(d => {
                max = d.value > max ? d.value : max
            })

            var div = d3.select("body").append("div")	
                .attr("class", "tooltip")				
                .style("opacity", 0);

            x.domain(dataset.map( d => { return d.month; }));
            y.domain([0, max]);

            svg.append("g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis);
            svg.append("g")
                .attr("class","y axis")
                .call(yAxis);

            svg.selectAll(".bar")
                .data(dataset)
                .enter().append("rect")
                .attr("class", "bar")
                .on("mouseover", function(d) {		
                        div.transition()		
                            .duration(200)		
                            .style("opacity", .9);		
                        div	.html(d.value)	
                            .style("left", (d3.event.pageX) + "px")		
                            .style("top", (d3.event.pageY - 28) + "px");	
                        })					
                    .on("mouseout", function(d) {		
                        div.transition()		
                            .duration(500)		
                            .style("opacity", 0);	
                    })
                .style("display", d => { return d.value === null ? "none" : null; })
                .style("fill",  d => { 
                    return d.value === d3.max(dataset,  d => { return d.value; }) 
                    ? highlightColor : barColor
                    })
                .attr("x",  d => { return x(d.month); })
                .attr("width", x.bandwidth())
                    .attr("y",  d => { return height; })
                    .attr("height", 0)
                        .transition()
                        .duration(750)
                        .delay(function (d, i) {
                            return i * 150;
                        })
                .attr("y",  d => { return y(d.value); })
                .attr("height",  d => { return height - y(d.value); })
                
                ;

            svg.selectAll(".label")        
                .data(dataset)
                .enter()
                .append("text")
                .attr("class", "label")
                .style("display",  d => { return d.value === null ? "none" : null; })
                .attr("x", ( d => { return x(d.month) + (x.bandwidth() / 2) -8 ; }))
                    .style("fill",  d => { 
                        return d.value === d3.max(dataset,  d => { return d.value; }) 
                        ? highlightColor : greyColor
                        })
                .attr("y",  d => { return height; })
                    .attr("height", 0)
                        .transition()
                        .duration(750)
                        .delay((d, i) => { return i * 150; })
                .attr("y",  d => { return y(d.value) + .1; })
                .attr("dy", "-.7em")
        } 
    </script>
    @endsection