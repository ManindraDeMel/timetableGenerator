<?PHP
if(isset($_POST)) {
    $subjectArr = array();
    $userTimetable = array(
        "Monday" => array(),
        "Tuesday" => array(),
        "Wednesday" => array(),
        "Thursday" => array(),
        "Friday" => array()
    );
    $timeTable = array(
        "Monday" => array(
            [   
                "1112RST5", 
                "1112VA2", 
                "1112RSTD3", 
                "12ENGL1", 
                "12MAT2",
                "1112BIO1",
                "12IT1",
                "12EXS1"
            ], 
            [   
                "1112RST9",
                "1112HW1",
                "1112OE2",
                "12PSY1",
                "12DG1",
                "12ENG4",
                "1112RSTD7"
            ], 
            [
                "1112EMA1",
                "12MMT1",
                "12SMD1",
                "12CHE1",
                "12ENG1",
                "1112DRA1"
            ]
        ),
        "Tuesday" => array(
            [   
                "1112RST3",
                "1112RST4",
                "1112VA1",
                "12MAT1",
                "12MMT2",
                "12SMT1",
                "12DT1",
                "1112GS1",
                "1112LLL1"
            ],
            [
                "1112FRE1",
                "1112IND1",
                "1112MUS1",
                "12PHO1",
                "12BIOH2",
                "12ENGL2",
                "12BUS1"
                 
            ],
            [
                "1112ENA1",
                "1112SOC1",
                "12B1OH1",
                "12LS1",
                "12PHY1",
                "12ENG3",
                "1112GS2"

            ]
        ),
        "Wednesday" => array(
            [
                "1112RST6",
                "12ECO1",
                "1112OE1",
                "12SMT2",
                "12CHE2",
                "12ENG2",
                "12HST1"

            ], 
            [
                "Wellbeing/Ministry"
            ],
            [
                "1112VA2",
                "12ENGL1",
                "12MAT2",
                "1112B1O1",
                "12IT1",
                "12EXS1"
                
            ]
        ),
        "Thursday" => array(
            [
                "1112RST7",
                "1112ENA1",
                "1112SOC1",
                "12BIOH1",
                "12LS1",
                "12PHY1",
                "12ENG3",
                "11126S2"
                
            ],
            [
                "1112VA1",
                "12MAT1",
                "12MMT2",
                "12SMT1",
                "12DT1",
                "11126S1",
                "1112LLL1"
                
            ],
            [
                "1112RST8",
                "1112FRE1",
                "1112IND1",
                "1112MUS1",
                "12PHO1",
                "1112RSTD6",
                "1112HPP6",
                "12BIOH2",
                "12ENGL2",
                "12BUS1",                
            ]
        ),
        "Friday" => array(
            [
                "1112RST1",
                "1112RST2",
                "1112EMA1",
                "12MMT1",
                "12SMD1",
                "12CHE1",
                "12ENG1",
                "1112DRA1"
                
            ], 
            [
                "12ECO1",
                "11120E1",
                "12SMT2",
                "12CHE2",
                "12ENG2",
                "12HST1"
                
            ],
            [
                "1112HW1",
                "1112OE2",
                "12PSY1",
                "12DG1",
                "12ENG4"
                
            ]
        ),
    );

    
    foreach($_POST as $class => $classNum) { // Appending user subjects
        if ($classNum > 0){
            array_push($subjectArr, $class . strval($classNum));
        }
    }
    foreach ($timeTable as $day => $periods) { // Finding the intersection between the global timetable and the user subjects
        foreach($periods as $index => $period){           
            if (empty(array_intersect($period, $subjectArr))) {
                if ($day == "Wednesday" && $index == 1){
                    array_push($userTimetable[$day], "Wellbeing/Ministry");
                }
                else {
                    array_push($userTimetable[$day], "Free");
                }                
            }
            else {
                array_push($userTimetable[$day], implode("", array_intersect($period, $subjectArr)));
            }            
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TimeTable generator</title>
    </head>
    <body>
        <h1>TimeTable</h1>
        <?PHP
        foreach ($userTimetable as $day => $periods) {
            echo "<h3>" . $day . ": </h3>";
            echo "<ul>";
            foreach ($userTimetable[$day] as $period) {
                echo "<li>" . $period . "</li>";
            }
            echo "</ul>";
            echo "<br><br>";
        }
        ?>
    </body>
</html>
