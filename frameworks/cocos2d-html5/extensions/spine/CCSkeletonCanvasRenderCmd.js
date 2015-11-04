/****************************************************************************
 Copyright (c) 2013-2014 Chukong Technologies Inc.

 http://www.cocos2d-x.org

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 ****************************************************************************/

(function(){
    sp.Skeleton.CanvasRenderCmd = function(renderableObject){
        cc.Node.CanvasRenderCmd.call(this, renderableObject);
        this._needDraw = true;
<<<<<<< HEAD
=======

        this._skeletonSprites = [];
>>>>>>> f582c68427c6682e16be99cb6b12cec92446801b
    };

    var proto = sp.Skeleton.CanvasRenderCmd.prototype = Object.create(cc.Node.CanvasRenderCmd.prototype);
    proto.constructor = sp.Skeleton.CanvasRenderCmd;

    proto.rendering = function (wrapper, scaleX, scaleY) {
<<<<<<< HEAD
        var node = this._node, i, n, slot, slotNode;
        wrapper = wrapper || cc._renderContext;

        var locSkeleton = node._skeleton, drawOrder = locSkeleton.drawOrder;
        for(i = 0, n = drawOrder.length; i < n; i++){
            slot = drawOrder[i];
            slotNode = slot._slotNode;
            if(slotNode._visible && slotNode._renderCmd && slot.currentSprite){
                slotNode._renderCmd.transform(this, true);
                slot.currentSprite._renderCmd.rendering(wrapper, scaleX, scaleY);
                slotNode._renderCmd._dirtyFlag = slot.currentSprite._renderCmd._dirtyFlag = 0;
            }
        }
=======
        var node = this._node, i, n, sprites = this._skeletonSprites, selSpriteCmd;
        wrapper = wrapper || cc._renderContext;

        //draw skeleton sprite by it self
        wrapper.save();
        //set to armature mode (spine need same way to draw)
        wrapper._switchToArmatureMode(true, this._worldTransform, scaleX, scaleY);
        for(i = 0, n = sprites.length; i < n; i++){
            selSpriteCmd = sprites[i]._renderCmd;
            if(selSpriteCmd && selSpriteCmd.rendering){
                selSpriteCmd.rendering(wrapper, scaleX, scaleY);
                selSpriteCmd._dirtyFlag = 0;
            }
        }
        wrapper._switchToArmatureMode(false);
        wrapper.restore();
>>>>>>> f582c68427c6682e16be99cb6b12cec92446801b

        if (!node._debugSlots && !node._debugBones)
            return;

        wrapper.setTransform(this._worldTransform, scaleX, scaleY);
<<<<<<< HEAD
        wrapper.setGlobalAlpha(1);
        var attachment, drawingUtil = cc._drawingUtil;
=======
        var locSkeleton = node._skeleton;
        var attachment, slot, drawingUtil = cc._drawingUtil;
>>>>>>> f582c68427c6682e16be99cb6b12cec92446801b
        if (node._debugSlots) {
            // Slots.
            drawingUtil.setDrawColor(0, 0, 255, 255);
            drawingUtil.setLineWidth(1);

            var points = [];
            for (i = 0, n = locSkeleton.slots.length; i < n; i++) {
                slot = locSkeleton.drawOrder[i];
                if (!slot.attachment || slot.attachment.type != sp.ATTACHMENT_TYPE.REGION)
                    continue;
                attachment = slot.attachment;
<<<<<<< HEAD
                this._updateRegionAttachmentSlot(attachment, slot, points);
=======
                sp._regionAttachment_updateSlotForCanvas(attachment, slot, points);
>>>>>>> f582c68427c6682e16be99cb6b12cec92446801b
                drawingUtil.drawPoly(points, 4, true);
            }
        }

        if (node._debugBones) {
            // Bone lengths.
            var bone;
            drawingUtil.setLineWidth(2);
            drawingUtil.setDrawColor(255, 0, 0, 255);

            for (i = 0, n = locSkeleton.bones.length; i < n; i++) {
                bone = locSkeleton.bones[i];
                var x = bone.data.length * bone.m00 + bone.worldX;
                var y = bone.data.length * bone.m10 + bone.worldY;
                drawingUtil.drawLine(
                    {x: bone.worldX, y: bone.worldY},
                    {x: x, y: y});
            }

            // Bone origins.
            drawingUtil.setPointSize(4);
            drawingUtil.setDrawColor(0, 0, 255, 255); // Root bone is blue.

            for (i = 0, n = locSkeleton.bones.length; i < n; i++) {
                bone = locSkeleton.bones[i];
                drawingUtil.drawPoint({x: bone.worldX, y: bone.worldY});
                if (i === 0)
                    drawingUtil.setDrawColor(0, 255, 0, 255);
            }
        }
    };

<<<<<<< HEAD
    proto._updateRegionAttachmentSlot = function(attachment, slot, points) {
        if(!points)
            return;

        var vertices = {}, VERTEX = sp.VERTEX_INDEX, bone = slot.bone;
        attachment.computeVertices(bone.skeleton.x, bone.skeleton.y, bone, vertices);
        points.length = 0;
        points.push(cc.p(vertices[VERTEX.X1], vertices[VERTEX.Y1]));
        points.push(cc.p(vertices[VERTEX.X4], vertices[VERTEX.Y4]));
        points.push(cc.p(vertices[VERTEX.X3], vertices[VERTEX.Y3]));
        points.push(cc.p(vertices[VERTEX.X2], vertices[VERTEX.Y2]));
    };

    proto._createChildFormSkeletonData = function(){
        var node = this._node;
        var locSkeleton = node._skeleton, spriteName, sprite;
        for (var i = 0, n = locSkeleton.slots.length; i < n; i++) {
            var slot = locSkeleton.slots[i], attachment = slot.attachment;
            var slotNode = new cc.Node();
            slot._slotNode = slotNode;

            if(attachment instanceof spine.RegionAttachment){
                spriteName = attachment.rendererObject.name;
                sprite = this._createSprite(slot, attachment);
                slot.currentSprite = sprite;
                slot.currentSpriteName = spriteName;
                slotNode.addChild(sprite);
            } else if(attachment instanceof spine.MeshAttachment){
                //todo for mesh
            }
        }
    };

    proto._createSprite = function(slot, attachment){
        var rendererObject = attachment.rendererObject;
        var texture = rendererObject.page._texture;
        var rect = new cc.Rect(rendererObject.x, rendererObject.y, rendererObject.width, rendererObject.height);
        var sprite = new cc.Sprite();
        sprite.initWithTexture(rendererObject.page._texture, rect, rendererObject.rotate, false);
        sprite._rect.width = attachment.width;
        sprite._rect.height = attachment.height;
        sprite.setContentSize(attachment.width, attachment.height);
        sprite.setRotation(-attachment.rotation);
        sprite.setScale(rendererObject.width / rendererObject.originalWidth * attachment.scaleX,
            rendererObject.height / rendererObject.originalHeight * attachment.scaleY);

        slot.sprites = slot.sprites || {};
        slot.sprites[rendererObject.name] = sprite;

        return sprite;
    };

    proto._updateChild = function(){
        var locSkeleton = this._node._skeleton, slots = locSkeleton.slots;
        var i, n, selSprite;

        var slot, attachment, slotNode;
        for(i = 0, n = slots.length; i < n; i++){
            slot = slots[i];
            attachment = slot.attachment;
            slotNode = slot._slotNode;
            if(!attachment){
                slotNode.setVisible(false);
                continue;
            }
            var type = attachment.type;
            if (type === spine.AttachmentType.region){
                if(attachment.rendererObject){
                    if(!slot.currentSpriteName || slot.currentSpriteName !== attachment.name){
                         var spriteName = attachment.rendererObject.name;
                        if(slot.currentSprite !== undefined)
                            slot.currentSprite.setVisible(false);
                        slot.sprites = slot.sprites ||{};
                        if(slot.sprites[spriteName] !== undefined)
                            slot.sprites[spriteName].setVisible(true);
                        else{
                            var sprite = this._createSprite(slot, attachment);
                            slotNode.addChild(sprite);
                        }
                        slot.currentSprite = slot.sprites[spriteName];
                        slot.currentSpriteName = spriteName;
                    }
                }
                var bone = slot.bone;
                slotNode.setPosition(bone.worldX + attachment.x * bone.m00 + attachment.y * bone.m01,
                    bone.worldY + attachment.x * bone.m10 + attachment.y * bone.m11);
                slotNode.setScale(bone.worldScaleX, bone.worldScaleY);

                //set the color and opacity
                selSprite = slot.currentSprite;
                selSprite._flippedX = bone.worldFlipX;
                selSprite._flippedY = bone.worldFlipY;
                if(selSprite._flippedY || selSprite._flippedX){
                    slotNode.setRotation(bone.worldRotation);
                    selSprite.setRotation(attachment.rotation);
                }else{
                    slotNode.setRotation(-bone.worldRotation);
                    selSprite.setRotation(-attachment.rotation);
                }

                //hack for sprite
                selSprite._renderCmd._displayedOpacity = 0 | (locSkeleton.a * slot.a * 255);
                var r = 0 | (locSkeleton.r * slot.r * 255), g = 0 | (locSkeleton.g * slot.g * 255), b = 0 | (locSkeleton.b * slot.b * 255);
                selSprite.setColor(cc.color(r,g,b));
                selSprite._renderCmd._updateColor();
            } else if (type === spine.AttachmentType.skinnedmesh) {
                //todo for mesh
            } else {
                slotNode.setVisible(false);
                continue;
            }
            slotNode.setVisible(true);
=======
    proto._createChildFormSkeletonData = function(){
        var node = this._node;
        var locSkeleton = node._skeleton, rendererObject, rect;
        for (var i = 0, n = locSkeleton.drawOrder.length; i < n; i++) {
            var slot = locSkeleton.drawOrder[i];
            var attachment = slot.attachment;
            if (!(attachment instanceof spine.RegionAttachment))
                continue;
            rendererObject = attachment.rendererObject;
            rect = cc.rect(rendererObject.x, rendererObject.y, rendererObject.width,rendererObject.height);
            var sprite = new cc.Sprite(rendererObject.page._texture, rect, rendererObject.rotate);
            this._skeletonSprites.push(sprite);
            slot.currentSprite = sprite;
        }
    };

    proto._updateChild = function(){
        var node = this._node;
        var locSkeleton = node._skeleton;
        locSkeleton.updateWorldTransform();
        var drawOrder = node._skeleton.drawOrder;
        for (var i = 0, n = drawOrder.length; i < n; i++) {
            var slot = drawOrder[i];
            var attachment = slot.attachment, selSprite = slot.currentSprite;
            if (!(attachment instanceof spine.RegionAttachment)) {
                if(selSprite)
                    selSprite.setVisible(false);
                continue;
            }
            if(!selSprite){
                var rendererObject = attachment.rendererObject;
                var rect = cc.rect(rendererObject.x, rendererObject.y, rendererObject.width,rendererObject.height);
                var sprite = new cc.Sprite(rendererObject.page._texture, rect, rendererObject.rotate);
                this._skeletonSprites.push(sprite);
                slot.currentSprite = sprite;
            }
            selSprite.setVisible(true);
            //update color and blendFunc
            selSprite.setBlendFunc(cc.BLEND_SRC, slot.data.additiveBlending ? cc.ONE : cc.BLEND_DST);

            var bone = slot.bone;
            selSprite.setPosition(bone.worldX + attachment.x * bone.m00 + attachment.y * bone.m01,
                    bone.worldY + attachment.x * bone.m10 + attachment.y * bone.m11);
            selSprite.setScale(bone.worldScaleX, bone.worldScaleY);
            selSprite.setRotation(- (slot.bone.worldRotation + attachment.rotation));
>>>>>>> f582c68427c6682e16be99cb6b12cec92446801b
        }
    };
})();