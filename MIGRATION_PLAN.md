# iForum Art Framework to ImpressCMS IPF Migration Plan

## Overview
This document outlines the complete migration strategy for converting the iForum module from the legacy Art framework to the modern ImpressCMS IPF (ImpressCMS Persistence Framework).

## Current State Analysis

### Art Framework Dependencies
- **Base Classes**: `ArtObject`, `ArtObjectHandler`
- **Framework Location**: `src/class/art/` directory (entire framework embedded)
- **Affected Classes**: 9+ object classes, 10+ handler classes
- **Handler Instantiation**: Already uses `icms_getmodulehandler()` (✓ Modern)

### Classes to Migrate

#### Object Classes (ArtObject → icms_ipf_Object)
1. `Forum` (src/class/forum.php)
2. `Post` (src/class/post.php) 
3. `Topic` (src/class/topic.php)
4. `Category` (src/class/category.php)
5. `Ntext` (src/class/text.php)
6. `Moderate` (src/class/moderate.php)
7. `Report` (src/class/report.php)
8. `Nrate` (src/class/rate.php)
9. `Digest` (src/class/digest.php)

#### Handler Classes (ArtObjectHandler → icms_ipf_Handler)
1. `IforumForumHandler`
2. `IforumTopicHandler` 
3. `IforumPostHandler`
4. `IforumCategoryHandler`
5. `IforumTextHandler`
6. `IforumModerateHandler`
7. `IforumReportHandler`
8. `IforumRateHandler`
9. `IforumDigestHandler` (already extends icms_core_ObjectHandler)

## Migration Steps

### Phase 1: Preparation
1. **Backup current codebase**
2. **Create IPF-compatible object definitions**
3. **Prepare migration scripts**

### Phase 2: Core Object Migration
1. **Replace ArtObject inheritance**:
   ```php
   // Before
   class Forum extends ArtObject
   
   // After  
   class Forum extends icms_ipf_Object
   ```

2. **Update constructor patterns**:
   ```php
   // Before
   function __construct() {
       parent::__construct("bb_forums");
       $this->initVar('forum_id', XOBJ_DTYPE_INT);
   }
   
   // After
   function __construct(&$handler, $data = array()) {
       $this->initVar('forum_id', XOBJ_DTYPE_INT);
       parent::__construct($handler, $data);
   }
   ```

### Phase 3: Handler Migration
1. **Replace ArtObjectHandler inheritance**:
   ```php
   // Before
   class IforumForumHandler extends ArtObjectHandler
   
   // After
   class IforumForumHandler extends icms_ipf_Handler
   ```

2. **Update handler constructors**:
   ```php
   // Before
   function __construct(&$db) {
       parent::__construct($db, 'bb_forums', 'Forum', 'forum_id', 'forum_name');
   }
   
   // After
   function __construct(&$db) {
       parent::__construct($db, 'forum', 'forum_id', 'Forum');
   }
   ```

### Phase 4: Remove Art Framework
1. **Delete src/class/art/ directory**
2. **Remove Art framework includes**
3. **Update functions.ini.php**

### Phase 5: Testing & Validation
1. **Test all CRUD operations**
2. **Verify permissions system**
3. **Test form handling**
4. **Validate template integration**

## Technical Details

### IPF Object Pattern
```php
class Forum extends icms_ipf_Object {
    function __construct(&$handler, $data = array()) {
        $this->initVar('forum_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('forum_name', XOBJ_DTYPE_TXTBOX, null, true, 150);
        // ... other field definitions
        parent::__construct($handler, $data);
    }
}
```

### IPF Handler Pattern  
```php
class IforumForumHandler extends icms_ipf_Handler {
    function __construct(&$db) {
        parent::__construct($db, 'forum', 'forum_id', 'Forum');
    }
}
```

### Key Differences
1. **Constructor signature**: IPF objects receive handler reference
2. **Table naming**: IPF uses module prefix automatically
3. **Field initialization**: Same `initVar()` pattern
4. **Handler methods**: Most methods compatible, some signatures differ

## Risk Assessment

### Low Risk
- Handler instantiation (already modern)
- Database operations (similar patterns)
- Basic CRUD operations

### Medium Risk  
- Custom handler methods
- Permission integration
- Form handling

### High Risk
- Complex object relationships
- Custom Art framework extensions
- Template integration edge cases

## Success Criteria
1. All existing functionality preserved
2. No Art framework dependencies
3. Modern ImpressCMS IPF compliance
4. Improved performance and maintainability
5. Full backward compatibility for data

## Timeline Estimate
- **Phase 1**: 1-2 days
- **Phase 2**: 3-4 days  
- **Phase 3**: 2-3 days
- **Phase 4**: 1 day
- **Phase 5**: 2-3 days
- **Total**: 9-13 days

## Next Steps
1. Begin with Category class (simplest)
2. Progress to Forum, Topic, Post (core entities)
3. Handle specialized classes (Digest, Report, etc.)
4. Complete with handler migrations
5. Remove Art framework
