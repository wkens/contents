#/bin/bash
for i in {0..36000} ; do
    ls -l --time-style=full-iso resources/assets/sass | egrep '^-' > .scsses.new
    d=`diff .scsses.new .scsses 2>&1`;
    if [ ! -z "$d" ] ; then
        echo "" >&2
        echo "Start gulp.js procession..." >&2
        node_modules/gulp/bin/gulp.js > .gulp.log 2>&1
        echo "End gulp.js procession." >&2
    fi
    cp -f .scsses.new .scsses
    sleep 1;
done;
echo "Stop auto_grub.sh" >&2
