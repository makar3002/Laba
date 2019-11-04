function check_format(data, type) {
    switch (type) {
        case 'word':
            for (var i = 0; i < data.length; i++) {
                if (data[i] >= '0' && data[i] <= '9') return false;
            }
            return true;
    }
    return false;
}
