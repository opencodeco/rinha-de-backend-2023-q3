sleep 10

mkdir $HOME/gatling/3.9.5
curl -L -o gatling.zip https://repo1.maven.org/maven2/io/gatling/highcharts/gatling-charts-highcharts-bundle/3.9.5/gatling-charts-highcharts-bundle-3.9.5-bundle.zip
mv ./gatling.zip $HOME/gatling/3.9.5/
unzip $HOME/gatling/3.9.5/gatling.zip -d $HOME/gatling/3.9.5/
mv $HOME/gatling/3.9.5/gatling*/* $HOME/gatling/3.9.5