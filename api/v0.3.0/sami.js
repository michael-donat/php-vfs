(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '    <ul>                <li data-name="namespace:VirtualFileSystem" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="VirtualFileSystem.html">VirtualFileSystem</a>                    </div>                    <div class="bd">                            <ul>                <li data-name="namespace:VirtualFileSystem_Structure" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="VirtualFileSystem/Structure.html">Structure</a>                    </div>                    <div class="bd">                            <ul>                <li data-name="class:VirtualFileSystem_Structure_Directory" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="VirtualFileSystem/Structure/Directory.html">Directory</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_Structure_File" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="VirtualFileSystem/Structure/File.html">File</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_Structure_Node" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="VirtualFileSystem/Structure/Node.html">Node</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_Structure_Root" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="VirtualFileSystem/Structure/Root.html">Root</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:VirtualFileSystem_Wrapper" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="VirtualFileSystem/Wrapper.html">Wrapper</a>                    </div>                    <div class="bd">                            <ul>                <li data-name="class:VirtualFileSystem_Wrapper_FileHandler" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="VirtualFileSystem/Wrapper/FileHandler.html">FileHandler</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:VirtualFileSystem_Container" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="VirtualFileSystem/Container.html">Container</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_Factory" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="VirtualFileSystem/Factory.html">Factory</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_FileExistsException" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="VirtualFileSystem/FileExistsException.html">FileExistsException</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_FileSystem" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="VirtualFileSystem/FileSystem.html">FileSystem</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_NotFoundException" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="VirtualFileSystem/NotFoundException.html">NotFoundException</a>                    </div>                </li>                            <li data-name="class:VirtualFileSystem_Wrapper" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="VirtualFileSystem/Wrapper.html">Wrapper</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    {"type": "Namespace", "link": "VirtualFileSystem.html", "name": "VirtualFileSystem", "doc": "Namespace VirtualFileSystem"},{"type": "Namespace", "link": "VirtualFileSystem/Structure.html", "name": "VirtualFileSystem\\Structure", "doc": "Namespace VirtualFileSystem\\Structure"},{"type": "Namespace", "link": "VirtualFileSystem/Wrapper.html", "name": "VirtualFileSystem\\Wrapper", "doc": "Namespace VirtualFileSystem\\Wrapper"},
            
            {"type": "Class", "fromName": "VirtualFileSystem", "fromLink": "VirtualFileSystem.html", "link": "VirtualFileSystem/Container.html", "name": "VirtualFileSystem\\Container", "doc": "&quot;Class to hold the filesystem structure as object representation. It also provides access and factory methods for\nfile system management.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method___construct", "name": "VirtualFileSystem\\Container::__construct", "doc": "&quot;Class constructor. Sets factory and root object on init.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_setFactory", "name": "VirtualFileSystem\\Container::setFactory", "doc": "&quot;Sets Factory instance&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_factory", "name": "VirtualFileSystem\\Container::factory", "doc": "&quot;Returns Factory instance&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_root", "name": "VirtualFileSystem\\Container::root", "doc": "&quot;Returns Root instance&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_fileAt", "name": "VirtualFileSystem\\Container::fileAt", "doc": "&quot;Returns filesystem Node|Directory|File|Root at given path.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_hasFileAt", "name": "VirtualFileSystem\\Container::hasFileAt", "doc": "&quot;Checks whether filesystem has Node at given path&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_createDir", "name": "VirtualFileSystem\\Container::createDir", "doc": "&quot;Creates Directory at given path.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_createFile", "name": "VirtualFileSystem\\Container::createFile", "doc": "&quot;Creates file at given path&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_move", "name": "VirtualFileSystem\\Container::move", "doc": "&quot;Moves Node from source to destination&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Container", "fromLink": "VirtualFileSystem/Container.html", "link": "VirtualFileSystem/Container.html#method_remove", "name": "VirtualFileSystem\\Container::remove", "doc": "&quot;Removes node at $path&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem", "fromLink": "VirtualFileSystem.html", "link": "VirtualFileSystem/Factory.html", "name": "VirtualFileSystem\\Factory", "doc": "&quot;Factory class to encapsulate object creation.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Factory", "fromLink": "VirtualFileSystem/Factory.html", "link": "VirtualFileSystem/Factory.html#method___construct", "name": "VirtualFileSystem\\Factory::__construct", "doc": "&quot;Class constructor. Sets user\/group to current system user\/group.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Factory", "fromLink": "VirtualFileSystem/Factory.html", "link": "VirtualFileSystem/Factory.html#method_getRoot", "name": "VirtualFileSystem\\Factory::getRoot", "doc": "&quot;Creates Root object.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Factory", "fromLink": "VirtualFileSystem/Factory.html", "link": "VirtualFileSystem/Factory.html#method_updateMetadata", "name": "VirtualFileSystem\\Factory::updateMetadata", "doc": "&quot;Updates time and ownership of a node&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Factory", "fromLink": "VirtualFileSystem/Factory.html", "link": "VirtualFileSystem/Factory.html#method_updateFileTimes", "name": "VirtualFileSystem\\Factory::updateFileTimes", "doc": "&quot;Update file a\/c\/m times&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Factory", "fromLink": "VirtualFileSystem/Factory.html", "link": "VirtualFileSystem/Factory.html#method_getDir", "name": "VirtualFileSystem\\Factory::getDir", "doc": "&quot;Creates Directory object.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Factory", "fromLink": "VirtualFileSystem/Factory.html", "link": "VirtualFileSystem/Factory.html#method_getFile", "name": "VirtualFileSystem\\Factory::getFile", "doc": "&quot;Creates File object.&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem", "fromLink": "VirtualFileSystem.html", "link": "VirtualFileSystem/FileExistsException.html", "name": "VirtualFileSystem\\FileExistsException", "doc": "&quot;Thrown when trying to override Node at address (duplicate prevention).&quot;"},
                    
            {"type": "Class", "fromName": "VirtualFileSystem", "fromLink": "VirtualFileSystem.html", "link": "VirtualFileSystem/FileSystem.html", "name": "VirtualFileSystem\\FileSystem", "doc": "&quot;Main &#039;access&#039; class to vfs implementation. It will register new stream wrapper on instantiation.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\FileSystem", "fromLink": "VirtualFileSystem/FileSystem.html", "link": "VirtualFileSystem/FileSystem.html#method___construct", "name": "VirtualFileSystem\\FileSystem::__construct", "doc": "&quot;Class constructor. Will register both, the stream default options and wrapper handler.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\FileSystem", "fromLink": "VirtualFileSystem/FileSystem.html", "link": "VirtualFileSystem/FileSystem.html#method_scheme", "name": "VirtualFileSystem\\FileSystem::scheme", "doc": "&quot;Returns wrapper scheme.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\FileSystem", "fromLink": "VirtualFileSystem/FileSystem.html", "link": "VirtualFileSystem/FileSystem.html#method___destruct", "name": "VirtualFileSystem\\FileSystem::__destruct", "doc": "&quot;Remoces wrapper registered for scheme associated with FileSystem instance.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\FileSystem", "fromLink": "VirtualFileSystem/FileSystem.html", "link": "VirtualFileSystem/FileSystem.html#method_container", "name": "VirtualFileSystem\\FileSystem::container", "doc": "&quot;Returns Container instance.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\FileSystem", "fromLink": "VirtualFileSystem/FileSystem.html", "link": "VirtualFileSystem/FileSystem.html#method_root", "name": "VirtualFileSystem\\FileSystem::root", "doc": "&quot;Returns Root instance.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\FileSystem", "fromLink": "VirtualFileSystem/FileSystem.html", "link": "VirtualFileSystem/FileSystem.html#method_path", "name": "VirtualFileSystem\\FileSystem::path", "doc": "&quot;Returns absolute path to full URI path (with scheme)&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem", "fromLink": "VirtualFileSystem.html", "link": "VirtualFileSystem/NotFoundException.html", "name": "VirtualFileSystem\\NotFoundException", "doc": "&quot;Thrown when non-existing Node is requested.&quot;"},
                    
            {"type": "Class", "fromName": "VirtualFileSystem\\Structure", "fromLink": "VirtualFileSystem/Structure.html", "link": "VirtualFileSystem/Structure/Directory.html", "name": "VirtualFileSystem\\Structure\\Directory", "doc": "&quot;FileSystem Directory representation.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Directory", "fromLink": "VirtualFileSystem/Structure/Directory.html", "link": "VirtualFileSystem/Structure/Directory.html#method___construct", "name": "VirtualFileSystem\\Structure\\Directory::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Directory", "fromLink": "VirtualFileSystem/Structure/Directory.html", "link": "VirtualFileSystem/Structure/Directory.html#method_addDirectory", "name": "VirtualFileSystem\\Structure\\Directory::addDirectory", "doc": "&quot;Adds child Directory.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Directory", "fromLink": "VirtualFileSystem/Structure/Directory.html", "link": "VirtualFileSystem/Structure/Directory.html#method_addFile", "name": "VirtualFileSystem\\Structure\\Directory::addFile", "doc": "&quot;Adds child File.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Directory", "fromLink": "VirtualFileSystem/Structure/Directory.html", "link": "VirtualFileSystem/Structure/Directory.html#method_size", "name": "VirtualFileSystem\\Structure\\Directory::size", "doc": "&quot;Returns size as the number of child elements.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Directory", "fromLink": "VirtualFileSystem/Structure/Directory.html", "link": "VirtualFileSystem/Structure/Directory.html#method_childAt", "name": "VirtualFileSystem\\Structure\\Directory::childAt", "doc": "&quot;Returns child Node existing at path.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Directory", "fromLink": "VirtualFileSystem/Structure/Directory.html", "link": "VirtualFileSystem/Structure/Directory.html#method_remove", "name": "VirtualFileSystem\\Structure\\Directory::remove", "doc": "&quot;Removes child Node&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Directory", "fromLink": "VirtualFileSystem/Structure/Directory.html", "link": "VirtualFileSystem/Structure/Directory.html#method_children", "name": "VirtualFileSystem\\Structure\\Directory::children", "doc": "&quot;Returns children&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem\\Structure", "fromLink": "VirtualFileSystem/Structure.html", "link": "VirtualFileSystem/Structure/File.html", "name": "VirtualFileSystem\\Structure\\File", "doc": "&quot;Object representation of File.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\File", "fromLink": "VirtualFileSystem/Structure/File.html", "link": "VirtualFileSystem/Structure/File.html#method_size", "name": "VirtualFileSystem\\Structure\\File::size", "doc": "&quot;Returns Node size.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\File", "fromLink": "VirtualFileSystem/Structure/File.html", "link": "VirtualFileSystem/Structure/File.html#method_data", "name": "VirtualFileSystem\\Structure\\File::data", "doc": "&quot;Returns contents.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\File", "fromLink": "VirtualFileSystem/Structure/File.html", "link": "VirtualFileSystem/Structure/File.html#method_setData", "name": "VirtualFileSystem\\Structure\\File::setData", "doc": "&quot;Sets contents.&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem\\Structure", "fromLink": "VirtualFileSystem/Structure.html", "link": "VirtualFileSystem/Structure/Node.html", "name": "VirtualFileSystem\\Structure\\Node", "doc": "&quot;Abstract class to represent filesystem Node.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method___construct", "name": "VirtualFileSystem\\Structure\\Node::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_chmod", "name": "VirtualFileSystem\\Structure\\Node::chmod", "doc": "&quot;Changes access to file.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_mode", "name": "VirtualFileSystem\\Structure\\Node::mode", "doc": "&quot;Returns file mode&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_chown", "name": "VirtualFileSystem\\Structure\\Node::chown", "doc": "&quot;Changes ownership.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_user", "name": "VirtualFileSystem\\Structure\\Node::user", "doc": "&quot;Returns ownership.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_chgrp", "name": "VirtualFileSystem\\Structure\\Node::chgrp", "doc": "&quot;Changes group ownership.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_group", "name": "VirtualFileSystem\\Structure\\Node::group", "doc": "&quot;Returns group ownership.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_size", "name": "VirtualFileSystem\\Structure\\Node::size", "doc": "&quot;Returns Node size.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_basename", "name": "VirtualFileSystem\\Structure\\Node::basename", "doc": "&quot;Returns Node basename.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_setBasename", "name": "VirtualFileSystem\\Structure\\Node::setBasename", "doc": "&quot;Sets new basename&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_path", "name": "VirtualFileSystem\\Structure\\Node::path", "doc": "&quot;Returns node path.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_url", "name": "VirtualFileSystem\\Structure\\Node::url", "doc": "&quot;Returns node URL.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method___toString", "name": "VirtualFileSystem\\Structure\\Node::__toString", "doc": "&quot;Returns node absolute path (without scheme).&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_dirname", "name": "VirtualFileSystem\\Structure\\Node::dirname", "doc": "&quot;Returns Node parent absolute path.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_setAccessTime", "name": "VirtualFileSystem\\Structure\\Node::setAccessTime", "doc": "&quot;Sets last access time&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_setModificationTime", "name": "VirtualFileSystem\\Structure\\Node::setModificationTime", "doc": "&quot;Sets last modification time&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_setChangeTime", "name": "VirtualFileSystem\\Structure\\Node::setChangeTime", "doc": "&quot;Sets last inode change time&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_atime", "name": "VirtualFileSystem\\Structure\\Node::atime", "doc": "&quot;Returns last access time&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_mtime", "name": "VirtualFileSystem\\Structure\\Node::mtime", "doc": "&quot;Returns last modification time&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Node", "fromLink": "VirtualFileSystem/Structure/Node.html", "link": "VirtualFileSystem/Structure/Node.html#method_ctime", "name": "VirtualFileSystem\\Structure\\Node::ctime", "doc": "&quot;Returns last inode change time (chown etc.)&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem\\Structure", "fromLink": "VirtualFileSystem/Structure.html", "link": "VirtualFileSystem/Structure/Root.html", "name": "VirtualFileSystem\\Structure\\Root", "doc": "&quot;FileSystem Root representation.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Root", "fromLink": "VirtualFileSystem/Structure/Root.html", "link": "VirtualFileSystem/Structure/Root.html#method___construct", "name": "VirtualFileSystem\\Structure\\Root::__construct", "doc": "&quot;Class constructor.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Root", "fromLink": "VirtualFileSystem/Structure/Root.html", "link": "VirtualFileSystem/Structure/Root.html#method_setScheme", "name": "VirtualFileSystem\\Structure\\Root::setScheme", "doc": "&quot;Set root scheme for use in path method.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Root", "fromLink": "VirtualFileSystem/Structure/Root.html", "link": "VirtualFileSystem/Structure/Root.html#method_path", "name": "VirtualFileSystem\\Structure\\Root::path", "doc": "&quot;Returns URL to file.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Structure\\Root", "fromLink": "VirtualFileSystem/Structure/Root.html", "link": "VirtualFileSystem/Structure/Root.html#method_url", "name": "VirtualFileSystem\\Structure\\Root::url", "doc": "&quot;Returns node URL.&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem", "fromLink": "VirtualFileSystem.html", "link": "VirtualFileSystem/Wrapper.html", "name": "VirtualFileSystem\\Wrapper", "doc": "&quot;Stream wrapper class. This is the class that PHP uses as the stream operations handler.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stripScheme", "name": "VirtualFileSystem\\Wrapper::stripScheme", "doc": "&quot;Returns path stripped of url scheme (http:\/\/, ftp:\/\/, test:\/\/ etc.)&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_getContainerFromContext", "name": "VirtualFileSystem\\Wrapper::getContainerFromContext", "doc": "&quot;Returns Container object fished form default&lt;em&gt;context&lt;\/em&gt;options by scheme.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_tell", "name": "VirtualFileSystem\\Wrapper::stream_tell", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_close", "name": "VirtualFileSystem\\Wrapper::stream_close", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_open", "name": "VirtualFileSystem\\Wrapper::stream_open", "doc": "&quot;Opens stream in selected mode.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_write", "name": "VirtualFileSystem\\Wrapper::stream_write", "doc": "&quot;Writes data to stream.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_stat", "name": "VirtualFileSystem\\Wrapper::stream_stat", "doc": "&quot;Returns stat data for file inclusion. Currently disabled.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_url_stat", "name": "VirtualFileSystem\\Wrapper::url_stat", "doc": "&quot;Returns file stat information&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_read", "name": "VirtualFileSystem\\Wrapper::stream_read", "doc": "&quot;Reads and returns $bytes amount of bytes from stream.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_eof", "name": "VirtualFileSystem\\Wrapper::stream_eof", "doc": "&quot;Checks whether pointer has reached EOF.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_mkdir", "name": "VirtualFileSystem\\Wrapper::mkdir", "doc": "&quot;Called in response to mkdir to create directory.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_metadata", "name": "VirtualFileSystem\\Wrapper::stream_metadata", "doc": "&quot;Called in response to chown\/chgrp\/touch\/chmod etc.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_seek", "name": "VirtualFileSystem\\Wrapper::stream_seek", "doc": "&quot;Sets file pointer to specified position&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_stream_truncate", "name": "VirtualFileSystem\\Wrapper::stream_truncate", "doc": "&quot;Truncates file to given size&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_rename", "name": "VirtualFileSystem\\Wrapper::rename", "doc": "&quot;Renames\/Moves file&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_unlink", "name": "VirtualFileSystem\\Wrapper::unlink", "doc": "&quot;Deletes file at given path&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_rmdir", "name": "VirtualFileSystem\\Wrapper::rmdir", "doc": "&quot;Removes directory&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_dir_opendir", "name": "VirtualFileSystem\\Wrapper::dir_opendir", "doc": "&quot;Opens directory for iteration&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_dir_closedir", "name": "VirtualFileSystem\\Wrapper::dir_closedir", "doc": "&quot;Closes opened dir&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_dir_readdir", "name": "VirtualFileSystem\\Wrapper::dir_readdir", "doc": "&quot;Returns next file url in directory&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper.html#method_dir_rewinddir", "name": "VirtualFileSystem\\Wrapper::dir_rewinddir", "doc": "&quot;Resets directory iterator&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper/DirectoryHandler.html", "name": "VirtualFileSystem\\Wrapper\\DirectoryHandler", "doc": "&quot;User as directory handle by streamWrapper implementation.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\DirectoryHandler", "fromLink": "VirtualFileSystem/Wrapper/DirectoryHandler.html", "link": "VirtualFileSystem/Wrapper/DirectoryHandler.html#method_setDirectory", "name": "VirtualFileSystem\\Wrapper\\DirectoryHandler::setDirectory", "doc": "&quot;Sets directory in context.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\DirectoryHandler", "fromLink": "VirtualFileSystem/Wrapper/DirectoryHandler.html", "link": "VirtualFileSystem/Wrapper/DirectoryHandler.html#method_iterator", "name": "VirtualFileSystem\\Wrapper\\DirectoryHandler::iterator", "doc": "&quot;Returns children iterator&quot;"},
            
            {"type": "Class", "fromName": "VirtualFileSystem\\Wrapper", "fromLink": "VirtualFileSystem/Wrapper.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html", "name": "VirtualFileSystem\\Wrapper\\FileHandler", "doc": "&quot;User as file handle by streamWrapper implementation.&quot;"},
                                                        {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_setFile", "name": "VirtualFileSystem\\Wrapper\\FileHandler::setFile", "doc": "&quot;Sets file in context.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_write", "name": "VirtualFileSystem\\Wrapper\\FileHandler::write", "doc": "&quot;Writes data to file. Will return the number of bytes written. Will advance pointer by number of bytes written.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_read", "name": "VirtualFileSystem\\Wrapper\\FileHandler::read", "doc": "&quot;Will read and return $bytes bytes from file. Will advance pointer by $bytes bytes.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_position", "name": "VirtualFileSystem\\Wrapper\\FileHandler::position", "doc": "&quot;Returns current pointer position.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_seekToEnd", "name": "VirtualFileSystem\\Wrapper\\FileHandler::seekToEnd", "doc": "&quot;Moves pointer to the end of file (for append modes).&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_offsetPosition", "name": "VirtualFileSystem\\Wrapper\\FileHandler::offsetPosition", "doc": "&quot;Offsets position by $offset&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_atEof", "name": "VirtualFileSystem\\Wrapper\\FileHandler::atEof", "doc": "&quot;Tells whether pointer is at the end of file.&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_truncate", "name": "VirtualFileSystem\\Wrapper\\FileHandler::truncate", "doc": "&quot;Removed all data from file and sets pointer to 0&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_setReadOnlyMode", "name": "VirtualFileSystem\\Wrapper\\FileHandler::setReadOnlyMode", "doc": "&quot;Sets handler to read only&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_setReadWriteMode", "name": "VirtualFileSystem\\Wrapper\\FileHandler::setReadWriteMode", "doc": "&quot;Sets handler into read\/write mode&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_setWriteOnlyMode", "name": "VirtualFileSystem\\Wrapper\\FileHandler::setWriteOnlyMode", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_isWritable", "name": "VirtualFileSystem\\Wrapper\\FileHandler::isWritable", "doc": "&quot;Checks if pointer allows writing&quot;"},
                    {"type": "Method", "fromName": "VirtualFileSystem\\Wrapper\\FileHandler", "fromLink": "VirtualFileSystem/Wrapper/FileHandler.html", "link": "VirtualFileSystem/Wrapper/FileHandler.html#method_isReadable", "name": "VirtualFileSystem\\Wrapper\\FileHandler::isReadable", "doc": "&quot;Checks if pointer allows reading&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


