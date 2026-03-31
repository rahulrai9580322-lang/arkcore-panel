<form action="process_gen.php" method="POST">
    <div class="mb-4">
        <label class="form-label">TARGET GAME PACKAGE</label>
        <input type="text" name="gamePackage" class="form-control form-control-custom" value="com.pubg.imobile" required>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="form-label">VALIDITY DURATION</label>
            <select name="keyDuration" class="form-select form-control-custom">
                <option value="30">1 Month Plan (₹10,000)</option>
                <option value="60">2 Months Plan (₹20,000)</option>
            </select>
        </div>
        <div class="col-md-6 mb-4">
            <label class="form-label">DEVICE LIMIT</label>
            <select name="deviceLimit" class="form-select form-control-custom">
                <option value="1">1 HWID</option>
                <option value="2">2 HWID</option>
            </select>
        </div>
    </div>

    <button type="submit" name="generate" class="btn btn-ark w-100 mt-4">
        AUTHORIZE & GENERATE KEY
    </button>
</form>