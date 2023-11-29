// format date
function extractDatePart(dateTimeString) {
    const dateTime = new Date(dateTimeString);
    const day = dateTime.getDate().toString().padStart(2, "0");
    const month = (dateTime.getMonth() + 1).toString().padStart(2, "0");
    const year = dateTime.getFullYear();
    return `${day}-${month}-${year}`;
}

// function for load options in select
function populateOption(api_link, authToken, selector, selectedId = null) {
    let htmlOption = "<option value=''></option>";
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            let allData = results.data;
            // console.log(allData);

            if (allData) {
                if (selectedId !== null) {
                    $.each(allData, function (index, data) {
                        if (data.id == selectedId) {
                            htmlOption +=
                                '<option value="' +
                                data.id +
                                '" selected>' +
                                data.name +
                                "</option>";
                        } else {
                            htmlOption +=
                                '<option value="' +
                                data.id +
                                '">' +
                                data.name +
                                "</option>";
                        }
                    });
                } else {
                    $.each(allData, function (index, data) {
                        htmlOption +=
                            '<option value="' +
                            data.id +
                            '">' +
                            data.name +
                            "</option>";
                    });
                }
            }

            selector.html(htmlOption);
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function populateProviderOption(
    api_link,
    authToken,
    selector,
    selectedId = null
) {
    let htmlOption = "<option value=''></option>";
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            let allData = results.data;
            console.log(allData);

            if (allData) {
                if (selectedId !== null) {
                    $.each(allData, function (index, data) {
                        if (data.id == selectedId) {
                            htmlOption +=
                                '<option value="' +
                                data.id +
                                '" selected>' +
                                data.batchCode +
                                " (" +
                                data.GEOLocation +
                                ")" +
                                "</option>";
                        } else {
                            htmlOption +=
                                '<option value="' +
                                data.id +
                                '">' +
                                data.batchCode +
                                " (" +
                                data.GEOLocation +
                                ")" +
                                "</option>";
                        }
                    });
                } else {
                    $.each(allData, function (index, data) {
                        htmlOption +=
                            '<option value="' +
                            data.id +
                            '">' +
                            data.batchCode +
                            " (" +
                            data.GEOLocation +
                            ")" +
                            "</option>";
                    });
                }
            }

            selector.html(htmlOption);
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function populateTrainerOption(
    api_link,
    authToken,
    selector,
    selectedId = null
) {
    let htmlOption = "<option value=''></option>";
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            let allData = results.data;
            console.log(allData);

            if (allData) {
                if (selectedId !== null) {
                    $.each(allData, function (index, data) {
                        if (data.ProfileId == selectedId) {
                            htmlOption +=
                                '<option value="' +
                                data.ProfileId +
                                '" selected>' +
                                data.profile.KnownAsBangla +
                                " (" +
                                data.profile.Email +
                                ") (" +
                                data.profile.NID +
                                ") " +
                                "</option>";
                        } else {
                            htmlOption +=
                                '<option value="' +
                                data.ProfileId +
                                '">' +
                                data.profile.KnownAsBangla +
                                " (" +
                                data.profile.Email +
                                ") (" +
                                data.profile.NID +
                                ") " +
                                "</option>";
                        }
                    });
                } else {
                    $.each(allData, function (index, data) {
                        let name = data.profile ? data.profile.KnownAs : "";
                        htmlOption +=
                            '<option value="' +
                            data.ProfileId +
                            '">' +
                            data.profile.KnownAsBangla +
                            " (" +
                            data.profile.Email +
                            ") (" +
                            data.profile.NID +
                            ") " +
                            "</option>";
                    });
                }
            }

            selector.html(htmlOption);
        },
        error: function (response) {
            console.log(response);
        },
    });
}
