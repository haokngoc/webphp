<?php
// Đường dẫn đến tệp JSON
$jsonFileName = '/var/www/html/web/data.json';

// Đọc dữ liệu từ tệp JSON
$jsonData = file_get_contents($jsonFileName);
$data = json_decode($jsonData, true);

// Kiểm tra xem có dữ liệu không trước khi sử dụng
if ($data) {
    $ipAddress = isset($data['settings']['ip-address']) ? $data['settings']['ip-address'] : '';
    $loggingMethod = isset($data['settings']['logging-method']) ? $data['settings']['logging-method'] : '';
    $loggingLevel = isset($data['settings']['logging-level']) ? $data['settings']['logging-level'] : '';
    $wirelessMode = isset($data['settings']['wireless-mode']) ? $data['settings']['wireless-mode'] : '';
    $wirelessSSID = isset($data['settings']['wireless-SSID']) ? $data['settings']['wireless-SSID'] : '';
    $wirelessPassPhrase = isset($data['settings']['wireless-Pass-Phrase']) ? $data['settings']['wireless-Pass-Phrase'] : '';
} else {
    // Xử lý trường hợp không đọc được dữ liệu từ tệp JSON
    // Có thể đặt các giá trị mặc định hoặc thông báo lỗi tùy thuộc vào yêu cầu
    $ipAddress = $loggingMethod = $loggingLevel = $wirelessMode = $wirelessSSID = $wirelessPassPhrase = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="logo.jpg" type="image">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<nav>
    <h1>Control Panel</h1>
    <ul>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="change_password.php">Change Password</a></li>
        <li><a href="update_firmware.php">Update Firmware</a></li>
        <li><a href="information.php">Information</a></li>
        <li><a href="logfile.php">LogFile</a></li>
        <li><a href="update_country_codes.php">Update Country Codes</a></li>
        <li><a href="factory_image.php">Factory Image</a></li>
    </ul>
</nav>
<div class="container">
    <form action="save_data_setting.php" method="post">
        <p><strong>Network Settings</strong></p>
        <label for="ip-address">IP Address:</label>
        <input type="text" id="ip-address" name="ip-address" value="<?php echo $ipAddress; ?>">

        <p><strong>Logging Settings</strong></p>
        <label for="logging-method">Logging Method:</label>
        <input type="text" id="logging-method" name="logging-method" value="<?php echo $loggingMethod; ?>">
        <br>
        <label for="logging-level">Logging Level:</label>
        <select id="logging-level" name="logging-level">
            <option value="debug" <?php echo ($loggingLevel === 'debug') ? 'selected' : ''; ?>>Debug</option>
            <option value="info" <?php echo ($loggingLevel === 'info') ? 'selected' : ''; ?>>Info</option>
            <option value="warning" <?php echo ($loggingLevel === 'warning') ? 'selected' : ''; ?>>Warning</option>
            <option value="error" <?php echo ($loggingLevel === 'error') ? 'selected' : ''; ?>>Error</option>
        </select>

        <p><strong>Wireless Settings</strong></p>
        <label>Wireless Mode:</label>
        <input type="radio" id="station" name="wireless-mode" value="station" <?php echo ($wirelessMode === 'station') ? 'checked' : ''; ?>>
        <label for="station">Station</label>

        <input type="radio" id="access-point" name="wireless-mode" value="access-point" <?php echo ($wirelessMode === 'access-point') ? 'checked' : ''; ?>>
        <label for="access-point">Access Point</label>
        <p>Valid SSID and Pas Phrase characters are 0-9,A-Z,a-z,!#%+,-,.?[]^_}</p>
        <br>
        <label for="wireless-SSID">Wireless SSID:</label>
        <input type="text" id="wireless-SSID" name="wireless-SSID" value="<?php echo $wirelessSSID; ?>">
        <br>
        <label for="wireless-Pass-Phrase">Wireless Pass Phrase:</label>
        <input type="text" id="wireless-Pass-Phrase" name="wireless-Pass-Phrase" value="<?php echo $wirelessPassPhrase; ?>">
        <br>
        <button type="submit" name="update-button">Update</button>
    </form>
</div>
</body>
</html>
