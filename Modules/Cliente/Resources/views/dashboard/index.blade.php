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
            height: 18px;					
            padding: 2px;				
            font: 12px sans-serif;		
            background: #303e45;	
            border: 0px;		
            border-radius: 8px;			
            pointer-events: none;		
            color:white;
        }

    </style>
@endsection
@section('content') 

    <div class="container">

        <div class="row col-4">

                <select name="ano" id="" class="form-control">
                    @foreach($anos as $ano)   
                        <option value="{{$ano->ano}}"> {{$ano->ano}} </option>
                    @endforeach        
                </select> 

        </div>

        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body  text-center">
                    <h5 class="card-title">Média de Gasto por Compra</h5>
                    <h3 id='mediagasto'>
                    </h3>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Clientes</h5>
                    <h3 id='totalclientes'>
                    </h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total de Vendas</h5>
                    <h3 id='totalvendas'>
                    </h3>
                </div>
                </div>
            </div>
        </div>


        <div class="row mt-3">

            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Valor Total das Compras (R$)</h5>
                        <div >
                            <svg id='totalCompras' preserveAspectRatio='xMinYMin meet' viewBox='0 0 460 320'></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card h-100">                     

                    <div class="card-body text-center">
                            <h5 class="card-title">Produtos Vendidos</h5>
                            <div>
                                <svg id='totalProdutos' preserveAspectRatio='xMinYMin meet' viewBox='0 0 460 320'></svg>
                            </div>
                            <select name="produto" id="" class="form-control">
                                @foreach($produtos as $produto)   
                                    <option value="{{$produto->id}}"> {{$produto->nome}} </option>
                                @endforeach        
                            </select>
                             
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

            $.get(main_url+"/cliente/dashboard/totalVendasMes/2019", function(dataset){
            
                datasetVendas = []

                Object.keys(dataset).map((key) => {
                    datasetVendas.push({
                    month: key, 
                    value: dataset[key]
                    })
                })

                grafico("#totalCompras", datasetVendas);
                    
            });

            $.get(main_url+"/cliente/dashboard/totalclientes/2019", function(dataset){
                $('#totalclientes').append(dataset);
            });

            $.get(main_url+"/cliente/dashboard/totalvendas/2019", function(dataset){
                $('#totalvendas').append(dataset);
            });

            $.get(main_url+"/cliente/dashboard/mediagasto/2019", function(dataset){
                $('#mediagasto').append("R$ "+dataset);
            }); 


            $.get(main_url+"/cliente/dashboard/vendasProdutoMes/"+$("[name=produto]").val()+"/2019", function(dataset){
        
                datasetProdutos = []

                Object.keys(dataset).map((key) =>{
                    datasetProdutos.push({
                        month: key, 
                        value: dataset[key]
                    })                    
                })                
                grafico("#totalProdutos", datasetProdutos);
            });            
           
        });

        $(document).on('change', '[name=produto]', function(){
            $.get(main_url+"/cliente/dashboard/vendasProdutoMes/"+$(this).val()+"/2019", function(dataset){
        
                datasetProdutos = []

                Object.keys(dataset).map((key) =>{
                    datasetProdutos.push({
                        month: key, 
                        value: dataset[key]
                    })
                })

                grafico("#totalProdutos", datasetProdutos);
            });   
        })
                       
        function grafico(id, dataset){

            $(id).html("")

            var margin = {top: 15, right: 15, bottom: 25, left: 30},
            width = 460 - margin.left - margin.right,
            height = 320 - margin.top - margin.bottom;

            var greyColor = "#898989";
            var barColor = d3.interpolateInferno(0.4);
            var highlightColor = d3.interpolateInferno(0.3);

            var formatPercent = d3.format(",.2f");

            var svg = d3.select(id).append("svg")
            .append("g")
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

            var x = d3.scaleBand()
                .range([0, width])
                    .padding(0.4);
                    
            var y = d3.scaleLinear()
                .range([height, 0]);

            var xAxis = d3.axisBottom(x).tickSize([]).tickPadding(10);
            var yAxis = d3.axisLeft(y);

            var max = 0;

            dataset.map( d => {
                max = d.value > max ? d.value : max
            })

            var div = d3.select("body").append("div")	
                .attr("class", "tooltip")				
                .style("opacity", 0);
            
            x.domain(dataset.map( d => { return d.month}));
            y.domain([0, (max+1)]);;

            svg.append("g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis)
                .selectAll("text")
                    .style("font-size", 12)
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
                        .duration(500)
                        .delay(function (d, i) {
                            return i * 50;
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