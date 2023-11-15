<?php

/**
 * Returns an array with prepared secure SELECT SQL query.
 * @param mysqli_stmt $stmt Prepared MySQL query.
 * @param array $params An array with referenced variables for SQL query.
 * For example: array(&$variable1, &$variable2, ... , &$variableN).
 * @return array|null
 */
function secureMysqliQuerySelect(mysqli_stmt $stmt,array $params):array|null{

    // Count input params and make a string with the type of input.
    $type = '';
    for ($i = 1; $i <= count($params); $i++) {
        $type .= "s";
    }

    // Create an array from two other arrays to pass it in function.
    $bindParams = array_merge(array($stmt, $type), $params);

    // Call the mysqli_stmt_bind_param function with the parameters stored in the $bindParams array.
    call_user_func_array('mysqli_stmt_bind_param', $bindParams);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    } else {
        die("Error executing statement: " . mysqli_stmt_error($stmt));
    }

}

/** The function makes the statement secure and executes it.
 * @param mysqli_stmt $stmt Prepared MySQL query.
 * @param array $params An array with referenced variables for SQL query.
 *  For example: array(&$variable1, &$variable2, ... , &$variableN).
 * @return bool
 */
function secureMysqliQueryExecute(mysqli_stmt $stmt, array $params):bool{

    // Count input params and make a string with the type of input.
    $type = '';
    for ($i = 1; $i <= count($params); $i++) {
        $type .= "s";
    }

    // Create an array from two other arrays to pass it in function.
    $bindParams = array_merge(array($stmt, $type), $params);

    // Call the mysqli_stmt_bind_param function with the parameters stored in the $bindParams array.
    call_user_func_array('mysqli_stmt_bind_param', $bindParams);

    return mysqli_stmt_execute($stmt);
}

/** The function makes prepared array with MySQL results for using with loops.
 * @param mysqli_stmt $stmt Prepared MySQL query.
 * @param array|null $params An array with variables to pass to the MySQL query.
 * @return array|null
 */
function secureMysqliQuerySelectForLoop(mysqli_stmt $stmt, array $params = null):array|null {

    // Count input params and make a string with the type of input.
    $paramTypes = '';
    for ($i = 1; $i <= count($params); $i++) {
        $paramTypes .= "s";
    }

    // Bind parameters if provided.
    if ($paramTypes && $params) {
        // Create a temporary array of references for parameters.
        $bindParams = array($stmt, $paramTypes);
        foreach ($params as &$param) {
            $bindParams[] = &$param;
        }

        // Call mysqli_stmt_bind_param with the temporary array.
        call_user_func_array('mysqli_stmt_bind_param', $bindParams);
    }

    // Execute the statement.
    if (mysqli_stmt_execute($stmt)) {
        // Get result set metadata
        $resultMetadata = mysqli_stmt_result_metadata($stmt);

        // Fetch field names from metadata.
        $fieldNames = array();
        while ($field = mysqli_fetch_field($resultMetadata)) {
            $fieldNames[] = $field->name;
        }

        // Create an array to hold result column references.
        $resultColumns = array_fill_keys($fieldNames, null); // Initialize with null.

        // Bind the result columns to references.
        $bindResultParams = array($stmt);
        foreach ($resultColumns as &$value) {
            $bindResultParams[] = &$value;
        }
        call_user_func_array('mysqli_stmt_bind_result', $bindResultParams);

        // Fetch and return the results.
        $results = array();
        while (mysqli_stmt_fetch($stmt)) {
            $row = array();
            foreach ($resultColumns as $key => $value) {
                $row[$key] = $value;
            }
            $results[] = $row;
        }

        return $results;
    } else {
        die("Error executing statement: " . mysqli_stmt_error($stmt));
    }
}
